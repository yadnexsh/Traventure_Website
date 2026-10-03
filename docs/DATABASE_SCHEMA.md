# Database Schema

**Status:** Confirmed Conceptual Data Model  
**Database:** PostgreSQL

## 1. Modelling principles

- Use stable primary keys, foreign keys, uniqueness constraints, indexes, and database constraints.
- Store timestamps in UTC; display in the relevant local timezone.
- Store money in precise integer units (e.g., paise for INR).
- Enforce booking invariants using PostgreSQL transactions and row-level locking (`lockForUpdate()`).
- Separate System Identity (`User`) from Contact Information (`CustomerRecord`) and Capacity Locks (`SeatAllocation`).

## 2. Core Entities

### User
- `id`, `email`, `password_hash`, `email_verified_at`, `role` (Admin, Customer), `timestamps`.
- Represents an authenticated identity. Required for online booking.

### CustomerRecord
- `id`, `user_id` (nullable), `name`, `phone`, `emergency_contact_info`, `timestamps`.
- Contains minimal contact details needed for operations. Can exist without a `User` (for offline bookings).

### Trek
- `id`, `slug`, `title`, `summary`, `difficulty`, `duration`, `published_status`, `timestamps`.

### Departure
- `id`, `trek_id`, `start_time`, `end_time`, `total_capacity`, `unused_offline_reserved_capacity`, `status`, `timestamps`.
- `total_capacity` must not be reduced below the number of currently active allocations.
- `unused_offline_reserved_capacity` tracks the pool of seats hidden from public online booking, explicitly reserved for future offline allocation.

### Reservation
- `id`, `customer_record_id`, `departure_id`, `status` (Draft, Confirmed, Cancelled), `payment_status` (Unpaid, Paid, Refunded), `price_snapshot`, `timestamps`.
- The logical container for a customer's trip, completely detached from the physical capacity lock.

### SeatAllocation
- `id`, `reservation_id`, `departure_id`, `allocation_type` (OnlineHold, OfflineAllocated, Confirmed), `expires_at` (nullable), `released_at` (nullable), `timestamps`.
- **OnlineHold:** `expires_at` is set to `now() + 15 mins`.
- **OfflineAllocated:** `expires_at` is null. Does not expire automatically. Created when the admin manually records a booking.
- Acts as the definitive lock on physical capacity. 

### PaymentAttempt (Future)
- `id`, `reservation_id`, `provider_reference`, `amount`, `status`, `idempotency_key`, `timestamps`.

### ExpressionOfInterest
- `id`, `departure_id`, `name`, `email`, `phone` (nullable), `consent_status`, `timestamps`.
- Used for the "I'm interested in this batch" feature. Does not consume capacity. Duplicate submissions from the same email for the same departure should be prevented or coalesced.

### AuditLog
- `id`, `actor_id` (nullable), `action`, `table_name`, `record_id`, `changes` (JSONB), `timestamps`.
- Records sensitive administrative actions (e.g., manual capacity overrides, seat releases, role changes).

## 3. Capacity Formula and State Transitions

### Capacity Formula
Publicly available online capacity is calculated dynamically. The database is the source of truth.

**Online Availability** = `total_capacity` - `unused_offline_reserved_capacity` - `Count(Active Offline Allocations)` - `Count(Active Online Allocations)`

Where **Active Allocations** are `SeatAllocation` records that belong to the departure AND:
- `released_at` is null AND
- (`expires_at` is null OR `expires_at` > `now()`)

*Example Transition:*
1. `total_capacity` = 20, `unused_offline_reserved_capacity` = 5. `Online Availability` = 15.
2. Admin creates an offline reservation for 2 seats from the offline-reserved pool.
3. `unused_offline_reserved_capacity` is decremented to 3.
4. Two `SeatAllocation` records (Active Offline Allocations) are created.
5. `Online Availability` = 20 - 3 - 2 - 0 = 15.
*(The public pool is unchanged, but 2 seats were consumed from the offline pool).*

### Seat Release Rules
If an admin releases an active offline allocation, the system must explicitly prompt the admin to decide whether those seats should:
a) Return to the `unused_offline_reserved_capacity` pool (incrementing it), OR
b) Become available for online booking (leaving `unused_offline_reserved_capacity` as is).

### Concurrency Handling
When allocating a seat:
1. Start a Laravel `DB::transaction()`.
2. Select the `Departure` using `lockForUpdate()`.
3. Calculate current `Online Availability`.
4. If available seats > 0 (for online), insert the `SeatAllocation`.
5. Commit transaction.

This serializes requests and entirely prevents race conditions for the final seat. Expired holds naturally stop counting in the capacity formula without requiring a scheduled cleanup job, preserving allocation history.

## 4. Identity Linking Deferred

A `Reservation` belongs to a `CustomerRecord`.
If an admin creates an offline reservation, `CustomerRecord.user_id` is null. Account linking is deferred to a future phase and there is currently no workflow for a customer to automatically or manually claim an offline reservation into their online account. Matching names or emails must NEVER trigger automatic merges.
