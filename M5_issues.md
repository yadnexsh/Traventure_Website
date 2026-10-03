| Area                              | Status                              |
| --------------------------------- | ----------------------------------- |
| Dedicated BookingService          | ✅                                   |
| PostgreSQL `lockForUpdate()`      | ✅                                   |
| Transaction around hold creation  | ✅                                   |
| 15-minute hold                    | ✅                                   |
| Expired holds dynamically ignored | ✅                                   |
| Historical holds preserved        | ✅                                   |
| Ownership check                   | ✅                                   |
| Verified-email requirement        | ✅                                   |
| Price snapshot source             | 🟡 Reasonable, but schema deviation |
| Payment kept out                  | ✅                                   |
| HTTP checkout kept out            | ✅ Correct                           |
| True concurrency test             | ❌ **Not actually tested**           |
| Confirmed allocation state        | 🟡 **Needs verification/fix**       |


The biggest issue: concurrency test
Second issue: confirming the allocation
About the price migration

This one is not automatically a problem.