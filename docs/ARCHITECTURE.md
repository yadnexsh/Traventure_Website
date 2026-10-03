# Architecture

**Status:** Confirmed Architecture Strategy  
**Stack:** Laravel (PHP) + PostgreSQL

## 1. Architecture goals

- Maintainable by a small team.
- Friendly to a non-technical business owner.
- Secure handling of accounts, bookings, payments, and sensitive trip information.
- Reliable capacity management using database-level concurrency controls.
- Good mobile UX, accessibility, and search discoverability.
- Reasonable operating cost and a credible path to future growth.

## 2. Core Architecture: Laravel Monolithic

The application will be built as a **modular monolith** using the Laravel framework. Microservices are explicitly out of scope. 

Laravel provides a robust, "batteries-included" foundation that handles routing, authentication, ORM (Eloquent), and queuing, keeping maintenance burden low and development velocity high.

## 3. Logical components

- **Public Web:** Home, trek discovery, trek pages, guides, articles, "Expression of Interest" submissions, and the online checkout flow.
- **Admin Web:** Trek/content editor, departure management, staff seat allocation, user roles, operational workflows, and audit logs.
- **Customer Portal:** Profile, own bookings, trip instructions, and updates.
- **Application Layer (Laravel):** Input validation, authentication, RBAC authorization, business rules, and transaction orchestration.
- **Database (PostgreSQL):** Durable records, strict constraints, row-level locks, transactions, and migrations.
- **Media Storage:** Images and approved documents, stored securely (e.g., AWS S3 or equivalent) with safe upload rules.
- **Payment Adapter (Deferred):** Future integration for gateway checkout, webhook verification, and reconciliation.
- **Observability:** Health checks, error monitoring, operational logs, and alerts that avoid sensitive data.

## 4. Critical data flows

### Capacity and Seat Allocation
The separation of seat allocation from payment status is a core architectural principle. 

1. **Online Booking:** A registered customer initiates checkout. The server verifies capacity within a database transaction, locks the row (`SELECT ... FOR UPDATE`), and creates a `SeatAllocation` with a 15-minute expiry.
2. **Staff Allocation:** Staff immediately allocates seats to a customer (registered or unregistered) via the admin panel. The allocation has no automatic expiry and immediately reduces available public capacity.
3. **Public Availability:** The system calculates available capacity dynamically. It never reveals whether a seat was booked online or by staff.

### Future Payment Processing (Razorpay)
1. Server creates a payment session through the gateway.
2. Gateway reports status through a verified webhook.
3. Idempotent processing updates payment status independently of the seat allocation.
4. Edge cases (delayed webhooks, payments arriving after hold expiry, duplicate webhooks) must be explicitly reconciled by documented business policies before integration. A browser redirect alone must never prove payment success.

### Content Publishing
1. Authorized editor creates a draft.
2. Reviewer approves content where required, especially safety-critical content.
3. Published version becomes available on the public site.
4. Important edits are recorded in the audit trail.

## 5. Hosting and Deployment Options

The application requires hosting for a PHP server (Laravel) and a PostgreSQL database.

**Option A: Laravel Forge + DigitalOcean (Recommended for balanced budget/complexity)**
- **Estimated Cost:** $25 - $45/month (Application Droplet + Managed Database).
- **Trade-offs:** Industry standard for Laravel. Easy automated deployments from GitHub. Requires minimal server maintenance, but is highly cost-effective and offers regions in India (Bangalore) for low latency. Backups provided by DigitalOcean.

**Option B: Managed PaaS (e.g., Render, Fly.io)**
- **Estimated Cost:** $50 - $100+/month.
- **Trade-offs:** Zero server management and easy auto-scaling. Higher monthly cost and sometimes limited Indian data center availability depending on the provider.

**Option C: Native Cloud (AWS/GCP)**
- **Estimated Cost:** $80 - $150+/month.
- **Trade-offs:** Maximum flexibility and durability, but significant devops overhead. Overkill for the first release.

*Note: Final hosting provider is subject to owner approval, but the application must be designed to be stateless and deployable via standard CI/CD pipelines.*

## 6. Environments and delivery

Plan local, test/CI, private staging, and production environments. The first milestone is a working local application followed by a private staging environment.

Use migrations, automated checks, code review, and a deployment/rollback process. Never copy production personal data into development or test environments.

## 7. Operational requirements

- HTTPS and managed secret storage in deployed environments.
- Least-privilege service accounts.
- Database backups with documented retention and tested restoration.
- Documented incident response and deployment rollback.
