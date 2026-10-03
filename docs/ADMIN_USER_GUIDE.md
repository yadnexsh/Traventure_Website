# Admin User Guide

**Status:** Starter outline — replace screenshots and steps with the actual implemented UI  
**Audience:** Owner, booking staff, content editors, and trek leaders/operations

## 1. What the admin panel is for

The admin panel is where authorized staff maintain trek information, manage departures and enquiries, review bookings, and coordinate approved operational updates. Menu labels and available actions depend on your role.

## 2. Signing in safely

1. Open the official admin URL.
2. Sign in using your assigned account (and MFA, if configured).
3. Use the approved account-recovery process if you cannot sign in.
4. Never share passwords or recovery secrets with other staff.

## 3. Creating a Trek and Departure

1. Open **Treks** and choose **Create trek**.
2. Complete the required content fields.
3. Save as a draft, preview, and publish when ready.
4. Open **Departures** for the trek.
5. Configure the **Total Capacity** (the maximum physical limit).
6. Configure the **Staff-Reserved Capacity** (seats hidden from the public, strictly for staff use).
7. Save the departure.

## 4. Manual Seat Allocation (Staff-Assisted Booking)

Staff can allocate seats directly to customers (no website account required).
1. Open the Departure.
2. Select **Allocate Seats**.
3. Enter the customer's contact details (creating a new Customer Record if needed).
4. Save the allocation.
5. **Important:** This immediately reduces the available capacity. These seats will **not** expire automatically. You must manually release them if payment is not collected outside the system.

## 5. Releasing Seats and Adjusting Capacity

**Releasing a Customer Allocation:**
1. Open the Reservation.
2. Select the allocated seat(s) and choose **Release Seats**.
3. Provide a reason. The capacity immediately returns to the public pool.

**Adjusting Staff-Reserved Capacity:**
1. Open the Departure.
2. If you want to make some staff-reserved seats available to the public, reduce the **Staff-Reserved Capacity** number.
3. Save. The public capacity will increase.

**Adjusting Total Capacity:**
You cannot reduce the total capacity below the number of seats already allocated. Ensure changes align with physical/operational limits.

## 6. Expressions of Interest

Customers can click "I'm interested in this batch" on full or upcoming departures.
1. Open the Departure.
2. View the **Expressions of Interest** tab to see counts and contact details.
3. Use this data to decide whether to release staff-reserved seats or schedule a new departure.
4. Do not use this data for marketing without explicit consent.

## 7. Identity Linking (Future)

If a customer later registers on the website and needs access to a reservation you created for them manually:
1. Do not simply change the email on the reservation.
2. Follow the secure verification process (e.g., sending a claim link to their email) to link the reservation to their new account.

## 8. Common Problems

- **Capacity Error:** You cannot allocate seats if the total capacity is reached.
- **Cannot sign in:** use the official recovery process.
- **Online Hold Expired:** Online holds last 15 minutes. If a customer calls saying their hold vanished, they must re-book if seats are still available.
