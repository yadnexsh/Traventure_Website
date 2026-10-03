# Booking and Payment Rules

**Status:** Confirmed Rules for Initial Release  
**Market:** India first  
**Model:** Hybrid admin-managed offline bookings and online customer checkout. Payment integration is deferred.

## 1. Core principles

- **Separation of Concerns:** Seat Allocation, Booking Status, and Payment Status are three distinct concepts. They must not be treated as the same thing.
- **Server Authority:** The database is the absolute source of truth for capacity, using PostgreSQL transactions and row-level locks.
- **Public Availability:** Accurate availability is shown publicly, but the system must **never** disclose whether seats were allocated by the admin or booked online.
- **Privacy:** Public visitors must never see internal notes, payment discussions, admin identities, or another customer's personal info.

## 2. Capacity Model

A `Departure` has a `total_capacity` and an `unused_offline_reserved_capacity`. 

**Active Allocations** (which consume capacity) include:
1. Active online checkout holds.
2. Confirmed or otherwise active online allocations.
3. Active offline (admin-recorded) allocations.

**Capacity Formula:**
`Online Availability = Total Capacity - Unused Offline-Reserved Capacity - Active Offline Allocations - Active Online Allocations`

*Note: The `unused_offline_reserved_capacity` pool hides seats from the public online checkout. When the admin manually allocates a seat from this pool, the unused pool integer decreases, and an Active Offline Allocation is created. Total approved capacity remains untouched, and public online availability is unaffected by this specific transaction.*

**Capacity Reduction Protections:**
If the admin attempts to reduce `total_capacity` below the number of currently committed or allocated seats, the system will block the change, display a clear explanation, and list the affected allocations for review. Silent cancellations or unrestricted force-saves are forbidden.

## 3. Online Customer Bookings

1. Customer registers and verifies their email.
2. Selects a departure.
3. The system checks capacity on the server using a transaction.
4. A successful allocation creates a `SeatAllocation` with a 15-minute checkout hold.
5. *(Future: Customer proceeds to Razorpay payment. Confirmed only on verified webhook.)*

**Hold Expiry:**
If the 15-minute hold expires, it immediately stops consuming capacity. This is calculated dynamically (`expires_at < now()`) so the system does not depend on a scheduled cleanup task to free the seat. The expired allocation record is preserved for history.

## 4. Admin-Recorded Offline Reservations

The admin handles customer contact and payment outside the website.
1. Admin creates a reservation (no customer account required).
2. Admin allocates seats directly against the departure via the admin panel.
3. **No Expiry:** Offline allocations do NOT expire automatically.
4. **Explicit Release:** Admin explicitly releases allocations if a customer cancels. The system will prompt whether the released capacity should return to the `unused_offline_reserved_capacity` pool or become available online.
5. **Payment:** Handled entirely outside the website for the first release.

## 5. Expression of Interest ("I'm interested in this batch")

A low-friction feature for customers to signal demand for a specific departure.
- Collects name, email, optional phone, and consent.
- Does **not** create a reservation, allocate seats, or consume capacity.
- Duplicate submissions from the same customer for the same departure must be prevented.
- Admin can view counts to decide whether to increase approved capacity, release offline-reserved seats, or create a new departure.
- Requires data retention policies and privacy consent.

## 6. Future Payment Considerations (Razorpay)

Razorpay is deferred. When implemented:
- Do not mark a booking confirmed merely because the customer returns to a success page.
- Business policies must be explicitly resolved before integration for edge cases:
  - Delayed payment notifications.
  - Payments arriving after the 15-minute hold expires (and capacity is gone).
  - Duplicate webhook events.
  - Refunds and reconciliation workflows.
