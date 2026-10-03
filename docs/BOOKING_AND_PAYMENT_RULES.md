# Booking and Payment Rules

**Status:** Confirmed Rules for Initial Release  
**Market:** India first  
**Model:** Hybrid manual/staff allocations and online customer checkout. Payment integration is deferred.

## 1. Core principles

- **Separation of Concerns:** Seat Allocation, Booking Status, and Payment Status are three distinct concepts. They must not be treated as the same thing.
- **Server Authority:** The database is the absolute source of truth for capacity, using PostgreSQL transactions and row-level locks.
- **Public Availability:** Accurate availability is shown publicly, but the system must **never** disclose whether seats were allocated by staff or booked online.
- **Privacy:** Public visitors must never see internal notes, payment discussions, staff identities, or another customer's personal info.

## 2. Capacity Model

A `Departure` has a `total_capacity` and a `staff_reserved_capacity`. 

**Active Allocations** (which consume capacity) include:
1. Active online checkout holds.
2. Confirmed or otherwise active online allocations.
3. Active staff-assisted customer allocations.

**Capacity Formula:**
`Available Online = total_capacity - staff_reserved_capacity - Active Allocations`

*Note: The `staff_reserved_capacity` pool hides seats from the public online checkout. When staff manually allocate a seat to a customer, it consumes an Active Allocation (which deducts from Available Online). Therefore, staff must explicitly decrease `staff_reserved_capacity` if they want to move those seats into the public pool. Unused staff-reserved seats must not be reported as confirmed bookings.*

Capacity changes (increasing or decreasing total/reserved capacity) must be validated against existing allocations and logged. Total capacity cannot drop below currently committed allocations.

## 3. Online Customer Bookings

1. Customer registers and verifies their email.
2. Selects a departure.
3. The system checks capacity on the server using a transaction.
4. A successful allocation creates a `SeatAllocation` with a 15-minute checkout hold.
5. *(Future: Customer proceeds to Razorpay payment. Confirmed only on verified webhook.)*

**Hold Expiry:**
If the 15-minute hold expires, it immediately stops consuming capacity. This is calculated dynamically (`expires_at < now()`) so the system does not depend on a scheduled cleanup task to free the seat. The expired allocation record is preserved for history.

## 4. Staff-Assisted Reservations

Staff communicate with customers directly (e.g., phone).
1. Staff creates a reservation (no customer account required, but a `CustomerRecord` is made).
2. Staff immediately allocates seats via the admin panel.
3. This creates a `SeatAllocation` that immediately reduces publicly available capacity.
4. **No Expiry:** Staff allocations do NOT expire automatically.
5. **Explicit Release:** Staff must explicitly release allocations when they decide the seats should become available again. A reason should be recorded in the audit trail.
6. **Payment:** Staff handle payment discussions and collection outside the website for the first release.

## 5. Expression of Interest ("I'm interested in this batch")

A low-friction feature for customers to signal demand for a specific departure.
- Collects name, email, optional phone, and consent.
- Does **not** create a reservation, allocate seats, or consume capacity.
- Duplicate submissions from the same customer for the same departure must be prevented.
- Staff can view counts and details to decide whether to increase capacity or release staff-reserved seats.
- Requires data retention policies and privacy consent.

## 6. Future Payment Considerations (Razorpay)

Razorpay is deferred. When implemented:
- Do not mark a booking confirmed merely because the customer returns to a success page.
- Business policies must be explicitly resolved before integration for edge cases:
  - Delayed payment notifications.
  - Payments arriving after the 15-minute hold expires (and capacity is gone).
  - Duplicate webhook events.
  - Refunds and reconciliation workflows.
