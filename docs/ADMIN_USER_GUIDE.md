# Admin User Guide

**Status:** Starter outline — replace screenshots and steps with the actual implemented UI  
**Audience:** Owner / Admin managing operations.

## 1. What the admin panel is for

The admin panel is where you maintain trek information, manage departures, review expressions of interest, and coordinate approved operational updates. This is also where you record offline bookings.

## 2. Signing in safely

1. Open the official admin URL.
2. Sign in using your assigned account (and MFA, if configured).
3. Use the approved account-recovery process if you cannot sign in.
4. Never share passwords or recovery secrets.

## 3. Creating a Trek and Departure

1. Open **Treks** and choose **Create trek**.
2. Complete the required content fields.
3. Save as a draft, preview, and publish when ready.
4. Open **Departures** for the trek.
5. Configure the **Total Capacity** (the maximum physical limit).
6. Configure the **Unused Offline-Reserved Capacity** (seats hidden from the public, specifically reserved for you to book customers offline).
7. Save the departure.

## 4. Admin-Recorded Offline Booking

When a customer calls or emails to book:
1. Open the Departure.
2. Select **Record Offline Booking**.
3. Enter the customer's contact details (they do not need an account on the website).
4. Select whether the seats should be deducted from the general online availability pool or your specific unused offline-reserved pool.
5. Save the allocation.
6. **Important:** These seats will **not** expire automatically. You must manually release them if the customer cancels or fails to pay.

## 5. Releasing Seats and Adjusting Capacity

**Releasing a Customer Allocation:**
1. Open the Reservation.
2. Select the allocated seat(s) and choose **Release Seats**.
3. The system will prompt you: Should these released seats return to your **Unused Offline-Reserved Pool** or become **Available for Online Booking**?
4. Select the appropriate choice and provide a reason.

**Adjusting Total Capacity:**
You cannot reduce the total capacity below the number of seats already allocated. If you try, the system will block the save and list the affected allocations. You must cancel/release allocations before lowering the total physical capacity.

## 6. Expressions of Interest

Customers can click "I'm interested in this batch" on full or upcoming departures.
1. Open the Departure.
2. View the **Expressions of Interest** tab to see counts and contact details.
3. Use this data to decide whether to release unused offline-reserved seats to the public or schedule a new departure.
4. Do not use this data for marketing without explicit consent.

## 7. Account Linking (Deferred)

In the current release, there is no automatic or manual workflow for a customer to link an offline booking to an online website account. Offline reservations remain fully managed by you through the admin panel.

## 8. Common Problems

- **Capacity Error:** You cannot allocate seats if the total capacity is reached.
- **Cannot sign in:** use the official recovery process.
- **Online Hold Expired:** Online holds last 15 minutes. If a customer calls saying their online checkout failed or vanished, they must re-book online if seats are still available, or you can record an offline booking for them.
