# Security and Privacy

**Status:** Confirmed Baseline Requirements

## 1. Principles

- Minimize data collection.
- Deny access by default and grant least privilege.
- Enforce authorization on the server for every protected operation.
- Keep secrets out of source control, client bundles, logs, and documentation.
- Make sensitive data access explainable and auditable.
- Test failure and recovery paths, not only successful flows.

## 2. Identity and Authentication

- **Customer Accounts:** Registration requires email verification before online booking is permitted.
- **Account Recovery:** Must use secure, expiring, single-use tokens, rate limiting, and generic responses that do not reveal whether an account exists. Sessions must be appropriately invalidated upon password change/recovery.
- **Staff Access:** Staff passwords or recovery secrets must never be disclosed to other staff. Consider Multi-Factor Authentication (MFA) for administrative accounts.
- **Identity Linking:** Customer records are NOT automatically merged by matching names or phone numbers. Secure verification (e.g., claiming via a secure email link) is required to link a staff-created reservation to a user account. Staff changing a reservation's email address does not bypass ownership verification.

## 3. Server-Side Authorization

- Use Role-Based Access Control (RBAC). Hiding a frontend button is not sufficient; all administrative endpoints must verify the user's role on the server.
- Define roles for owner, booking staff, content editor, trek leader/operations, and customer.
- Customers can only view their own bookings and profile.
- Staff must only access customer details, payments, and sensitive notes required for their specific role.
- Public visitors must **never** see internal notes, payment discussions, staff identities, or another customer's personal information. Public availability must not disclose whether seats were booked online or staff-allocated.

## 4. Application Protections

Apply controls appropriate to Laravel:
- Server-side validation and Eloquent ORM protections against injection.
- Protection against XSS (Blade escaping), CSRF (Laravel tokens), SSRF, and broken access control.
- Rate limits on authentication, recovery, enquiries, and Expression of Interest endpoints to prevent spam and duplicate inflation.
- Safe user-facing errors without stack traces.
- Dependency updates and vulnerability review.

## 5. Data Minimization and Privacy

- **Health and Safety Data:** Collect and retain only the information strictly necessary for trekking operations. Avoid broad medical questionnaires; ask only for necessary declarations. Restrict access to this information to authorized operational staff.
- **Expressions of Interest:** Provide clear privacy information and obtain consent for follow-up communications. Document retention and deletion rules for old interest submissions.
- **Data Deletion:** Implement policies to scrub sensitive health/emergency info after a trek is completed, adhering to legal requirements.

## 6. Audit, Logging, and Monitoring

Audit logs must track:
- Role changes and permission grants.
- Manual seat allocations and manual capacity releases.
- Total capacity and staff-reserved capacity changes on departures.
- Linking a reservation to a user account.
- Changes to health/medical data.

Logs must exclude passwords, secrets, card data, and unnecessary personal/medical information.

## 7. Backups and Incidents

- Define backup frequency, retention, access controls, and encryption for PostgreSQL.
- Test restoration periodically.
- Define incident triage, containment, escalation, and notification responsibilities.
