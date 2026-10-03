# Testing Strategy

**Status:** Confirmed Testing Plan

## 1. Objectives

Verify customer and admin workflows, protect booking/capacity integrity, enforce permissions, and catch regressions. Tests should be repeatable and safe to run without affecting real customers.

## 2. Test layers

- **Unit:** Test pure business logic (price calculations, state transitions, capacity formulas).
- **Integration:** Test PostgreSQL constraints/transactions, Laravel API authorization, and background jobs.
- **End-to-End:** Test important customer and admin journeys.
- **Accessibility and Responsive:** Automated accessibility scans and manual keyboard checks.
- **Security:** Object-level authorization, role boundaries, rate limits, session handling, and data leakage.

## 3. Concurrency and Capacity Tests

Because capacity management is critical, specific integration tests must target race conditions:
- **Final Seat Contention:** Simulate two simultaneous requests for the final seat. Prove that PostgreSQL row-level locking (`DB::transaction` with `lockForUpdate`) serialize the requests, granting one and denying the other.
- **Hold Expiry:** Prove that an online hold expiring immediately frees capacity without a cleanup job, while preserving the history record.
- **Concurrent Admin/Online Action:** Prove an admin capacity change cannot race with a customer online allocation, causing overbooking.
- **Capacity Reductions:** Prove the system blocks attempts to reduce `total_capacity` below the number of currently active allocations and returns a clear error.

## 4. Planned Acceptance Criteria

Before production launch, the following must pass:

1. **Auth:** Account registration requires a verified email. Secure account recovery works (expiring single-use tokens, rate-limited, generic responses).
2. **Online Holds:** Customer creates an online hold. Wait 15 minutes. Verify capacity returns to normal and the hold is marked expired.
3. **Offline Reservations:** Admin records an offline booking and allocates a seat. Verify public capacity drops immediately. Verify the hold does not expire after 15 minutes.
4. **Offline Reserved Capacity:** Configure a departure with 5 unused offline-reserved seats. Verify those 5 seats are invisible to public checkout. Admin allocates 2 seats from this pool. Verify unused pool drops to 3, total remains 20, and public online availability is unaffected.
5. **Releasing Seats:** Admin explicitly releases an offline-allocated seat. Verify they are prompted to return it to the offline-reserved pool or the online pool. Verify math applies correctly and an audit log is written.
6. **Privacy:** Verify accurate public availability is shown without disclosing whether seats are offline-recorded or online-booked.
7. **Expression of Interest:** Submit "I'm interested in this batch". Verify capacity is unchanged. Submit again with the same email. Verify duplicate is prevented. Verify admin sees the count.
8. **Authorization:** Customer tries to view another customer's booking. Verify strict RBAC denial.
9. **UI/UX:** Responsive design works on mobile viewports. Key workflows meet WCAG 2.2 AA standards.
10. **Deployment:** Local development environment and private staging deployment run successfully.
