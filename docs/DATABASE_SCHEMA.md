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
- `id`, `email`, `password_hash`, `email_verified_at`, `role` (Admin, BookingStaff, ContentEditor, TrekLeader, Customer), `timestamps`.
- Represents an authenticated identity. Required for online booking, but not for staff-created reservations.

### CustomerRecord
- `id`, `user_id` (nullable), `name`, `phone`, `emergency_contact_info`, `timestamps`.
- Contains minimal contact details needed for operations. Can exist without a `User`.

### Trek
- `id`, `slug`, `title`, `summary`, `difficulty`, `duration`, `published_status`, `timestamps`.

### Departure
- `id`, `trek_id`, `start_time`, `end_time`, `total_capacity`, `staff_reserved_capacity`, `status`, `timestamps`.
- `total_capacity` must not be reduced below the number of currently active allocations.

### Reservation
- `id`, `customer_record_id`, `departure_id`, `status` (Draft, Confirmed, Cancelled), `payment_status` (Unpaid, Paid, Refunded), `price_snapshot`, `timestamps`.
- The logical container for a customer's trip, completely detached from the physical capacity lock.

### SeatAllocation
- `id`, `reservation_id`, `departure_id`, `allocation_type` (OnlineHold, StaffAllocated, Confirmed), `expires_at` (nullable), `released_at` (nullable), `timestamps`.
- **OnlineHold:** `expires_at` is set to `now() + 15 mins`.
- **StaffAllocated:** `expires_at` is null. Does not expire automatically.
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

`Available Online Seats = Total Capacity - Staff Reserved Capacity - Count(Active Allocations)`

Where **Active Allocations** are `SeatAllocation` records that belong to the departure AND:
- `released_at` is null AND
- (`expires_at` is null OR `expires_at` > `now()`)

*Note: Unused staff-reserved capacity subtracts from online availability. When staff allocate a seat, it consumes an active allocation but does not change the `staff_reserved_capacity` integer.*

### Concurrency Handling
When allocating a seat:
1. Start a Laravel `DB::transaction()`.
2. Select the `Departure` using `lockForUpdate()`.
3. Calculate current `Available Online Seats`.
4. If available seats > 0 (for online) or total unallocated seats > 0 (for staff), insert the `SeatAllocation`.
5. Commit transaction.

This serializes requests and entirely prevents race conditions for the final seat. Expired holds naturally stop counting in the capacity formula without requiring a scheduled cleanup job, preserving allocation history.

## 4. Identity Linking

A `Reservation` belongs to a `CustomerRecord`.
If a staff member creates a reservation for an unregistered customer, `CustomerRecord.user_id` is null.
If the customer later registers, a secure verification process (e.g., emailing a secure, single-use claim link) must be used to set `CustomerRecord.user_id = User.id`. Records are NEVER automatically merged by matching names or emails.
