# AGENTS.md — Trek Company Platform

> **Purpose:** Project-wide instructions for AI coding agents working on this trekking-company platform.
>
> **Project status:** Greenfield. At the start, assume there is no frontend, backend, database, architecture, deployment setup, or security baseline unless repository inspection proves otherwise.
>
> **Primary users:** Trekkers and prospective customers; a non-technical business owner; booking/content staff; trek leaders and operations staff.
>
> **Initial market:** India. Design for future international customers and destinations without prematurely building a complex multi-region system.
>
> **Business model:** Trek discovery and education, hybrid enquiries and online bookings, online payment gateway, customer accounts/portal, admin panel, and staff/trek-leader workflows.
>
> **Important:** This file is a working agreement for development. It does not replace legal advice, qualified safety review, security review, or approval of the company's actual business policies.

---

## 1. Your role and priorities

Act as a careful product-minded software engineering partner. Depending on the task, work as a product analyst, UX designer, architect, full-stack engineer, database designer, test engineer, accessibility reviewer, and security-conscious maintainer.

Priorities, in order:

1. Human safety, privacy, security, and data integrity.
2. Correctness of booking, capacity, payment, cancellation, and operational workflows.
3. Clear, trustworthy user experience for customers and staff.
4. A genuinely usable admin experience for people who do not code.
5. Maintainable architecture and reliable automated tests.
6. Accessibility, performance, search discoverability, and responsive design.
7. Visual polish and additional features.

Do not optimize for a flashy demo at the expense of correct data, safe workflows, accessibility, or maintainability.

## 2. Non-negotiable agent behaviour

### 2.1 Inspect before changing

At the beginning of a task:

- Inspect the repository structure, current Git status, existing instructions, package manifests, tests, and relevant implementation.
- Read this file and any applicable nested agent instructions.
- Identify what already exists before proposing replacements.
- Preserve user changes. Never overwrite unrelated work.
- If the repository is empty, say so briefly and begin with planning rather than generating a large application immediately.

Do not assume a framework, cloud provider, database, package manager, payment provider, hosting platform, or existing design system before checking.

### 2.2 Plan and get approval at decision gates

For substantial work, provide:
- The problem and intended user outcome.
- Relevant assumptions and unresolved questions.
- A short implementation plan.
- Alternatives and trade-offs for consequential technical decisions.
- Data, security, cost, operational, and migration implications.
- How success will be tested.

Ask for explicit approval before:
- Committing to the initial application architecture or a materially different architecture.
- Selecting paid vendors or starting billable infrastructure.
- Enabling a payment gateway in live mode.
- Deploying to production, changing DNS, or sending real customer communications.
- Destructive database operations, data deletion, irreversible migrations, or bulk changes to production data.
- Changing approved cancellation, refund, eligibility, safety, privacy, or emergency policies.
- Collecting new categories of sensitive personal information.
- Adding recurring costs, telemetry that may expose personal data, or external services with material privacy implications.

Routine, reversible implementation choices within an approved plan do not require repeated approval. If a missing detail is not blocking, document a clearly labelled assumption and continue in a safe, reversible way.

### 2.3 Be honest about verification

- Never claim that code, tests, security, deployment, backups, payments, or integrations work unless they were actually checked.
- Report commands run and their outcomes, including failures and tests not run.
- Do not conceal warnings, failing tests, incomplete work, mock data, or unconfigured integrations.
- Distinguish a working implementation from a prototype, stub, mock, or future task.
- Never fabricate API responses, vendor capabilities, legal requirements, safety facts, trek statistics, reviews, certifications, or business policies.
- If external research is needed for current vendor documentation, security guidance, or legal obligations, use authoritative and up-to-date sources and record links and dates in the relevant documentation.

### 2.4 Keep work understandable

- Explain consequential decisions in plain language.
- Prefer small, reviewable changes over giant code dumps.
- Use clear names, simple abstractions, and consistent patterns.
- Avoid premature microservices, needless dependencies, overengineering, and clever code that is difficult for a small team to maintain.
- Do not introduce placeholder buttons that look functional but do nothing. Mark incomplete features clearly and avoid exposing them as ready for customers.
- Keep documentation and examples aligned with the actual implementation.

## 3. Product vision and scope

Build a trustworthy, information-rich trekking platform that helps people decide whether a trek is suitable, prepare responsibly, enquire or book confidently, and manage their trip. Give the business team a straightforward way to maintain content and run operations without writing code.

### 3.1 Customer-facing website

Plan for these areas, subject to the approved release scope:

- Home page with clear value proposition, seasonal or featured treks, practical guidance, and useful next steps.
- Trek discovery, search, filtering, and comparison.
- Individual trek pages with structured, scannable information.
- Day-by-day itinerary and route/elevation information when verified data is available.
- Preparation centre: fitness guidance, packing lists, altitude and weather awareness, responsible trekking, and beginner education.
- FAQs, contact details, enquiry forms, and transparent company information.
- Booking flow, availability, payment, confirmation, and cancellation/rescheduling information.
- Customer account/portal for profile, bookings, payment/receipt status, required trip information, and relevant updates.
- Policies: privacy, terms, cancellation/refund, booking conditions, and other applicable notices after review.
- Articles or guides with categories, tags, related content, and editorial review.
- Useful transactional email or messaging notifications, with consent and delivery failure handling where applicable.

Do not copy another trekking website's text, visual identity, code, photos, or proprietary materials. Use other websites only for high-level research and inspiration. Create an original brand and content.

### 3.2 Admin and operations platform

Build an admin panel as a core product, not an afterthought. The owner and small team must not need SQL, terminal commands, source-code edits, or direct database access for routine work.

Include, in stages:

- Dashboard for upcoming departures, booking/enquiry workload, capacity, payments requiring attention, and pending content or safety reviews.
- Trek and destination management.
- Departure/batch management with dates, capacity, price, status, meeting point, and operational notes.
- Day-by-day itinerary editor.
- Media library and image upload.
- Article, FAQ, policy, homepage, and reusable content management.
- Booking and participant management.
- Enquiry inbox and follow-up status.
- Payment and refund status, reconciled with the payment provider.
- Customer and staff account management with role-appropriate permissions.
- Trip updates and notification templates.
- Safety notices, document review dates, incident records, and escalation contacts with restricted access.
- Audit history for sensitive or important changes.
- Clear settings, helpful validation, empty states, confirmation screens, and recovery guidance.

Use plain-language labels. Avoid exposing internal database names, IDs, JSON, stack traces, or developer jargon to ordinary admins. Where a technical identifier is useful for support, place it in a secondary details view.

### 3.3 Roles and access

Design least-privilege roles and permission checks on the server. The exact permission matrix must be documented and approved.

Potential roles:
- **Owner/Admin:** business settings, team access, content, departures, bookings, and high-impact operations.
- **Booking staff:** enquiries, bookings, customer communications, and approved payment/refund workflows.
- **Content editor:** trek descriptions, articles, FAQs, and media, without access to unnecessary participant or payment data.
- **Trek leader/operations:** assigned departures, relevant participant information, operational checklists, and safety workflows.
- **Customer:** only their own profile, bookings, submitted information, and trip updates.

Do not rely on hiding a button in the frontend as authorization. Check permissions in every protected backend action and data query. Restrict medical declarations, emergency contacts, incident reports, payment details, and other sensitive records to people with a documented need.

## 4. Trek content and data quality

Trek information must be structured, consistent, editable, and reviewable. Avoid hardcoding trek data into page components.

A trek record may include, where relevant and verified:

- Name, slug, summary, destination, region, country, and trek category.
- Difficulty level with a documented internal definition.
- Duration, approximate distance, highest altitude, altitude gain/loss, and daily walking estimates.
- Starting/ending points, base camp, transport guidance, route notes, and map/elevation assets.
- Season and batch availability.
- Day-by-day itinerary with distance, duration, elevation, accommodation, and meal notes.
- Fitness prerequisites and preparation timeline.
- Packing list, clothing advice, weather variability, and equipment information.
- Known risks, altitude information, environmental considerations, and relevant eligibility guidance.
- Price, currency, inclusions, exclusions, taxes/fees where applicable, and additional expenses.
- Permit or local requirement information, with a source/review date where appropriate.
- Accommodation, meals, water, toilets, luggage/offloading, and transport arrangements.
- Cancellation/refund terms applicable to that booking.
- FAQs, image gallery, image credits/licences, and related guides.
- Editorial owner, verification source, last reviewed date, and publication status.

Not every trek will have every field. Define which fields are required for publication by trek type. Use explicit “not provided” or omit a field where appropriate; do not fill gaps with invented values.

### 4.1 Publishing workflow

Support at least:
- Draft
- Ready for review
- Approved/published
- Archived/unpublished

The exact workflow can be simplified for a small team, but published safety-critical information must have an identified reviewer and review date. Provide preview before publishing and a clear way to correct or withdraw outdated information.

The system should warn about missing required fields, expired review dates, broken links, missing image alt text, and departures without essential operational information. Do not silently publish incomplete safety-critical information.

### 4.2 Content truthfulness

- Label estimates as estimates.
- Explain that weather, trail conditions, altitude effects, and actual timings can vary.
- Do not promise guaranteed wildlife sightings, weather, views, summit success, safety, or exact travel times.
- Do not use fake testimonials, fabricated ratings, false scarcity, or misleading countdowns.
- Do not generate factual trek, permit, health, or safety advice without a reliable source and appropriate review.
- Maintain original content and image licensing records.

## 5. Discovery, usability, accessibility, and design

### 5.1 Core UX principles

- Mobile-first and responsive across small phones, tablets, and desktops.
- Make the next step obvious without pressuring the user.
- Show essential information early: difficulty, duration, season, fitness prerequisites, approximate price, dates, and availability when known.
- Keep filtering and comparison understandable and usable on touch screens.
- Avoid excessive pop-ups, dark patterns, confusing urgency, and unnecessary account creation.
- Preserve entered form data where safe after validation errors.
- Explain why information is requested, especially for emergency and trip-related information.
- Provide loading, empty, success, failure, and retry states for important actions.
- Make availability and price consistent between trek pages, checkout, confirmation, and admin.
- Clearly distinguish an enquiry from a confirmed booking and a payment initiated from a payment verified by the provider.

### 5.2 Accessibility

Aim for WCAG 2.2 AA, verifying against the applicable version and relevant requirements during implementation.

At minimum:
- Semantic HTML and logical heading hierarchy.
- Full keyboard navigation and visible focus.
- Accessible form labels, validation, and error announcements.
- Sufficient contrast and no color-only meaning.
- Meaningful alternative text and captions where appropriate.
- Reduced-motion support and no unnecessary animation.
- Accessible dialogs, menus, date pickers, filters, and booking flows.
- Manual keyboard and screen-reader spot checks in addition to automated scans.

### 5.3 Visual design system

Create a documented design system before building many pages:
- Typography, spacing, color, layout, breakpoints, buttons, form fields, cards, status indicators, dialogs, tables, and feedback patterns.
- Consistent public-site and admin patterns, while allowing the admin UI to prioritize operational clarity.
- Realistic mobile and desktop layouts.
- Reusable components with clear states and accessibility.
- Image optimization, sensible crops, aspect ratios, and loading placeholders.

Do not select a visual style solely because it is trendy. Establish a distinctive, outdoors-appropriate identity that remains readable and trustworthy. Obtain approval for the overall direction before extensive UI implementation.

## 6. Enquiries, bookings, departures, and capacity

Hybrid booking means some customers may complete online bookings while others enquire and receive manual assistance. Both paths must be clear and must not create conflicting reservations.

### 6.1 Enquiries

- Validate inputs on both client and server.
- Collect only necessary contact and trip-interest information.
- Include spam protection, rate limiting, and safe handling of untrusted content.
- Track status, owner, timestamps, and follow-up notes.
- Avoid exposing enquiries to unauthorized staff.
- Provide a clear confirmation that an enquiry is not a confirmed booking unless business rules explicitly say otherwise.
- Respect communication consent and applicable opt-out requirements.

### 6.2 Departures and availability

- Model a trek separately from its dated departures/batches.
- Define capacity, reserved seats, confirmed participants, waitlist rules, booking cutoff, minimum group size if used, and departure status.
- Prevent overselling with database transactions or an equivalent concurrency-safe strategy.
- Define whether a checkout temporarily holds a seat, for how long, and when the hold expires.
- Ensure abandoned/failed payments do not permanently consume capacity.
- Never rely only on client-side checks for price, capacity, eligibility, or booking status.
- Define a safe manual booking path that follows the same capacity and audit rules as online bookings.
- Handle edits to dates, capacity, prices, and cancellations without silently corrupting existing bookings.

### 6.3 Booking lifecycle

Document a state machine before implementation. Potential states include:
- Draft/inquiry
- Pending customer action
- Pending payment
- Payment verified
- Confirmed
- Waitlisted
- Cancellation requested
- Cancelled
- Refund pending
- Partially refunded/refunded
- Failed/expired

These are candidates, not a final required list. Agree on valid transitions, actor permissions, notifications, capacity effects, and audit events. Avoid impossible transitions and duplicate side effects.

Show the customer the status and next action in plain language. Keep an internal event history sufficient to investigate disputes and support requests.

## 7. Payments, refunds, and financial integrity

Use an established payment gateway suitable for the Indian market, subject to explicit approval of provider, fees, supported methods, settlement terms, compliance responsibilities, and integration design. Keep the integration replaceable behind a small, well-defined service boundary where practical.

Requirements:
- Use provider-hosted checkout or tokenized payment methods where practical; never store raw card numbers, CVVs, or payment credentials.
- Verify payment status on the server with the provider, using signed webhooks and/or provider API verification.
- Verify webhook signatures and reject invalid events.
- Handle duplicate and out-of-order webhook deliveries idempotently.
- Do not mark an order paid solely because the browser returns to a success URL.
- Validate amount, currency, order reference, and expected transaction state.
- Use idempotency keys for payment creation/refund operations where supported.
- Keep payment attempts, provider references, booking state, refunds, and reconciliation status distinct.
- Never log secrets, full payment instruments, or unnecessary personal data.
- Provide a safe process for partial refunds, failed refunds, disputes, and reconciliation.
- Use test/sandbox credentials until the full payment flow has passed review.
- Do not enable live payment collection until the owner explicitly approves the provider and launch checklist.
- Ensure the UI explains when a payment is pending and how duplicate submissions are prevented.

Tax treatment, invoices, receipts, refund terms, accounting requirements, and applicable payment rules must be confirmed with the business and qualified advisers. Do not invent them.

## 8. Customer accounts and staff portals

- Customers can securely sign in, recover accounts, update appropriate profile details, view their own bookings, and see relevant trip instructions.
- Enforce ownership checks on every record; never trust a user-supplied booking ID by itself.
- Do not reveal whether an email address has an account in a way that enables account enumeration.
- Use secure session management and appropriate protections against cross-site request forgery where relevant.
- Define whether guest checkout is supported; do not require an account unless the approved UX/business rules justify it.
- Staff see only assigned or permitted information.
- Trek leaders should receive only the information needed for assigned departures and only for the required time.
- Build account deletion/export workflows in accordance with approved retention, legal, and operational requirements. Explain any records that cannot be immediately removed and why, after qualified review.
- Do not use customer data for unrelated marketing without a valid basis and required consent.

## 9. Safety and operational responsibility

The platform can support safety operations; it cannot guarantee a safe trek or replace trained personnel, local judgement, emergency services, or a documented operating system.

### 9.1 Safety information

- Each trek needs reviewed, trek-specific prerequisites, hazards, equipment guidance, emergency arrangements, and escalation information.
- Explain that conditions can change and that operational staff may modify, delay, or cancel a trek under approved policy.
- Show safety-critical information before checkout and provide access to it after booking.
- Version important acknowledgements so the business can determine which version a participant saw and accepted, including timestamp and policy version where appropriate.
- Do not imply that a disclaimer eliminates the company's responsibilities.
- Never infer medical fitness from a form or automated score.
- Any health or altitude guidance must be reviewed by a qualified professional and operational safety lead before publication.

### 9.2 Emergency contacts and sensitive declarations

- Collect only information necessary for an identified operational or legal purpose.
- Explain purpose, access, retention, and how the data will be used.
- Encrypt data in transit and at rest using suitable platform controls.
- Restrict access by role and assignment; log access to particularly sensitive records where feasible.
- Do not expose this data in public APIs, URLs, analytics, error traces, or ordinary application logs.
- Define retention and deletion rules with qualified review.
- Avoid storing detailed medical histories unless specifically justified, approved, and protected.
- Do not transmit sensitive details through email or messaging unless the channel and content have been appropriately assessed.

### 9.3 Operational safety workflows

Plan for:
- Pre-departure readiness checklist and named owner.
- Participant/leader manifests with least-privilege access.
- Weather and route advisories with source, timestamp, reviewer, and affected departures.
- Emergency contact directory and escalation tree.
- Incident/near-miss recording with restricted access and an audit trail.
- Evacuation/contingency plan references and handover notes.
- Departure changes, postponement, cancellation, and participant notification workflows.
- Safety notice acknowledgement where needed.
- Review dates and reminders for safety-critical content.

Do not invent an emergency number, rescue capability, local authority contact, evacuation route, weather status, or live trail condition. These must be verified for the actual destination and operating context.

## 10. Security and privacy baseline

Security is part of the initial architecture, not a final polish task.

### 10.1 Application security

- Use maintained frameworks and supported dependency versions.
- Validate and normalize input at trust boundaries; use parameterized database queries or safe ORM operations.
- Apply context-appropriate output encoding and protect against injection, XSS, CSRF, SSRF, insecure deserialization, path traversal, and broken access control as applicable.
- Apply rate limiting to authentication, password recovery, enquiry forms, and sensitive endpoints.
- Use secure password hashing if managing passwords directly; prefer a well-maintained authentication solution where appropriate.
- Require strong owner/admin authentication and evaluate MFA before production.
- Set secure cookie/session attributes and sensible expiry/revocation behaviour.
- Configure security headers, HTTPS, CORS, and allowed origins deliberately.
- Restrict file type, size, and content for uploads; generate safe filenames, store files safely, and prevent uploaded content from executing.
- Keep dependencies patched and review dependency/security alerts.
- Avoid exposing stack traces, secrets, internal IDs, or personal data in user-facing errors.
- Use least-privilege database and service accounts.
- Add audit logs for role changes, sensitive data access where appropriate, content publication, booking/payment adjustments, refunds, and safety-critical changes.

### 10.2 Secrets and environments

- Keep secrets out of source control, client bundles, logs, documentation, and screenshots.
- Provide a `.env.example` containing names and safe placeholders only.
- Validate required environment variables at startup and fail with actionable, non-sensitive errors.
- Separate local, test, staging, and production credentials and data.
- Do not copy production personal data into development or tests.
- Use a secret manager or hosting-platform secret store for deployed environments where available.
- Never disable TLS validation or security controls merely to make a development integration work.

### 10.3 Privacy and compliance planning

The initial market is India, with potential international customers later. Before launch, identify the actual jurisdictions, data flows, vendors, and obligations. Have qualified advisers review applicable privacy/data protection, consumer, e-commerce, tax, accessibility, marketing, and payment requirements.

- Create a data inventory: data item, purpose, collection point, legal/operational basis, access roles, vendors, storage location, and retention.
- Minimize data collection and avoid collecting sensitive data “just in case.”
- Publish accurate privacy and cookie/consent information as applicable.
- Define access, correction, export, deletion, retention, and incident response processes.
- Review analytics, email, maps, CAPTCHA, hosting, storage, and payment vendors for privacy impact.
- Do not claim legal compliance solely because a checklist or automated scan passes.

## 11. Architecture and technology selection

No stack is pre-approved. Before implementation, compare a small number of credible options and recommend one balanced approach suitable for a small team, a non-technical owner, Indian operations, payment integration, and future growth.

Evaluate:
- Developer experience and hiring/maintenance availability.
- Accessibility and SEO.
- Type safety and testability.
- Secure authentication and authorization.
- Database integrity and migrations.
- Media storage and delivery.
- Hosting reliability, backups, observability, and regional needs.
- Payment and notification integration support.
- Total cost, including recurring services, bandwidth, email/SMS, storage, payment fees, and backups.
- Portability and realistic exit/migration options.

Prefer a well-structured modular monolith over microservices unless demonstrated requirements justify a more distributed architecture. Use managed services when they materially reduce operational burden without unacceptable lock-in or cost. Keep public pages, admin, APIs, database, background jobs, and integrations separated by clear responsibilities even if deployed together.

Before approval, provide:
1. Proposed stack and why it fits.
2. At least one credible alternative and its trade-offs.
3. High-level architecture diagram or written component map.
4. Data model outline and critical relationships.
5. Authentication/authorization approach.
6. Hosting, backup, monitoring, and deployment approach.
7. Estimated cost categories and any assumptions.
8. Key risks and how they will be mitigated.

Do not install a large set of dependencies or scaffold the full application before the architecture gate is approved.

## 12. Database and data integrity

- Design normalized, understandable data models for treks, destinations, departures, users, roles, enquiries, bookings, participants, payment attempts, refunds, content, media, safety notices, and audit events as appropriate.
- Use stable primary keys, foreign keys, uniqueness constraints, appropriate indexes, and database-level invariants.
- Store timestamps consistently, normally in UTC, and display them in the relevant local timezone. Make timezone assumptions explicit for departures.
- Use explicit currency codes and integer minor units or an equally precise representation; never use floating-point arithmetic for money.
- Record price/currency snapshots on bookings so future trek price edits do not rewrite historical purchases.
- Track created/updated timestamps and actor IDs for important records.
- Use migrations for schema changes; review them before applying to shared or production databases.
- Define deletion, archival, and retention semantics before cascading deletes across bookings, financial records, or incident records.
- Use transactions for operations that must succeed or fail together.
- Add constraints for duplicate booking references, webhook event processing, and other invariants where applicable.
- Seed only clearly marked fictional development data. Never seed fake testimonials or let sample data appear as real public content.
- Test backups and restoration, not merely backup creation.

## 13. API, integrations, and background work

- Define API contracts, validation schemas, error formats, authorization rules, and pagination before building multiple clients around an endpoint.
- Return clear user-safe errors without leaking implementation details.
- Make retryable integrations idempotent where possible.
- Handle timeouts, rate limits, provider outages, and partial failure.
- Use a background job mechanism for work that should not block user requests, such as appropriate notifications, media processing, reminders, or reconciliation.
- Record job status and failures and provide a safe retry path.
- Do not retry financial or messaging operations blindly when doing so could duplicate side effects.
- Keep vendor-specific code behind small adapters when that improves testability and future replacement.
- Do not claim an integration is configured when credentials, webhooks, sender verification, or production setup are missing.

Potential integrations such as payment gateways, email/SMS, maps, analytics, weather data, and customer support tools must be evaluated and approved before use. Avoid unnecessary integrations in the first release.

## 14. Notifications and communication

- Define notification events, recipients, templates, channel, consent requirements, retry policy, and audit needs.
- Separate transactional messages (e.g. booking status) from marketing.
- Use templates editable by authorized staff where practical, with safe placeholders and previews.
- Avoid exposing sensitive participant details in messages.
- Do not send real emails, SMS, or WhatsApp messages in development or tests; use sandbox services, mocks, or captured test messages.
- Make delivery failures visible to staff and provide a safe resend workflow.
- Prevent duplicate notifications when payment webhooks or background jobs are repeated.
- Obtain approval before configuring live sender domains, paid messaging, or marketing automation.

## 15. SEO, performance, and discoverability

- Use meaningful, stable URLs and handle slug changes with redirects where appropriate.
- Provide unique titles, descriptions, canonical URLs, sitemap, robots directives, Open Graph metadata, and useful internal links.
- Add structured data only when accurate, applicable, and supported by current specifications; never mark up fabricated ratings or prices.
- Ensure important trek content is rendered and discoverable by search engines.
- Optimize images, responsive sizes, modern formats, lazy loading below the fold, and layout stability.
- Avoid loading third-party scripts without a clear purpose and privacy review.
- Measure performance on realistic mobile conditions and use current Core Web Vitals guidance as a target.
- Add analytics only after choosing an appropriate privacy-conscious approach and defining useful metrics.

Useful business metrics may include trek page engagement, enquiry completion, booking funnel drop-off, successful payments, cancellation rates, and admin task completion. Do not collect more personal data than necessary to measure them.

## 16. Testing and quality gates

Testing must grow with the application. Select tools based on the approved stack and document how to run them.

### 16.1 Required testing layers

- Unit tests for business rules, calculations, validation, permissions, and state transitions.
- Integration tests for database operations, API endpoints, payment callbacks/webhooks, and external-service adapters.
- End-to-end tests for core customer and admin journeys.
- Accessibility checks plus manual keyboard testing.
- Responsive layout checks for key pages.
- Security-focused tests for authorization boundaries, rate limits, upload validation, session handling, and sensitive data exposure.
- Regression tests for bugs once fixed.
- Migration and backup/restore verification before production.
- Payment sandbox tests covering success, failure, pending status, duplicate webhook, invalid signature, refund, and timeout/retry scenarios.

### 16.2 Minimum critical journeys

Test at least:
1. Visitor finds and compares treks.
2. Visitor reads prerequisites and safety information.
3. Visitor submits an enquiry and staff can process it.
4. Customer selects a departure and sees accurate availability and price.
5. Concurrent booking attempts cannot exceed capacity.
6. Customer completes or abandons payment and the booking reaches the correct state.
7. Duplicate/out-of-order payment events do not double-charge, double-book, or duplicate side effects.
8. Customer can view only their own bookings.
9. Staff can only access actions and data allowed by their role.
10. Admin creates, previews, edits, publishes, unpublishes, and archives content.
11. Admin can safely adjust a departure, handle a cancellation/refund workflow, and view the audit trail.
12. Safety-critical updates are reviewed and shown accurately to affected customers.
13. Important forms work on mobile and with a keyboard.
14. Recovery/error states provide understandable next steps.

### 16.3 Before calling a task complete

Run relevant formatters, linting, type checks, tests, and production build when available. Inspect the diff and confirm:
- No secrets or personal data were added.
- No unrelated changes were made.
- Documentation and migrations are updated.
- Loading, error, empty, and success states are handled.
- Authorization is enforced server-side.
- Critical flows are tested or their untested status is clearly stated.

Never weaken tests, remove security checks, or silence warnings merely to obtain a green build without explaining and justifying the change.

## 17. Deployment, operations, and recovery

Plan separate local, staging, and production environments.

Before production:
- Approved hosting, domain, DNS, TLS/HTTPS, database, object storage, email sender, payment provider, and monitoring are configured.
- Production secrets are stored securely and not committed.
- Database migrations are reviewed and a recovery/rollback plan exists.
- Backups have a documented schedule, retention, access policy, and tested restoration procedure.
- Health checks, error monitoring, logs, and relevant alerts are configured.
- Logs avoid credentials, payment secrets, and unnecessary personal/sensitive data.
- A deployment checklist, release notes, rollback procedure, and incident contacts exist.
- Owner/admin accounts are created securely and default/demo credentials are removed.
- Accessibility, security, payment sandbox, booking capacity, and core end-to-end checks have passed.
- Policies, safety content, support contact details, and customer communication templates are reviewed.
- Live payments and outbound communications are enabled only after explicit approval.

Do not deploy to production or make irreversible infrastructure changes without authorization. Use staging and reversible rollout approaches where practical.

Define recovery objectives with the owner: how much data loss is tolerable and how quickly the service must recover. Do not invent these values; record them as unresolved until approved.

## 18. Documentation requirements

Keep these documents current as the project develops. Create them when their corresponding decisions are made; do not fabricate completed decisions before approval.

- `README.md` — project purpose, prerequisites, setup, commands, and links to documentation.
- `docs/PRODUCT_REQUIREMENTS.md` — users, goals, scope, assumptions, non-goals, acceptance criteria.
- `docs/ARCHITECTURE.md` — system components, key decisions, data flows, deployment view.
- `docs/ADR/` — short Architecture Decision Records for consequential choices.
- `docs/DATABASE_SCHEMA.md` — entities, relationships, constraints, retention, migrations.
- `docs/DESIGN_SYSTEM.md` — design tokens, components, responsive and accessibility rules.
- `docs/BOOKING_AND_PAYMENT_RULES.md` — approved state machines, capacity rules, pricing, payment and refund behaviour.
- `docs/SAFETY_OPERATIONS.md` — approved operational workflows, review responsibilities, escalation and incident procedures.
- `docs/SECURITY_AND_PRIVACY.md` — threat considerations, data inventory, roles, retention, secrets, incident response.
- `docs/TESTING_STRATEGY.md` — test layers, commands, environments, release gates.
- `docs/DEPLOYMENT_RUNBOOK.md` — environment setup, releases, rollback, backup and restoration.
- `docs/ADMIN_USER_GUIDE.md` — plain-language instructions for the owner and staff.
- `docs/CONTENT_GUIDE.md` — trek content schema, editorial checks, image rights, review cadence.
- `.env.example` — variable names and safe placeholder values only.

A suggested directory tree is illustrative, not mandatory. Adapt it to the approved stack and repository conventions.

## 19. Phased implementation roadmap

Use incremental, demonstrable milestones. Reorder only with an explanation and approval when the change affects scope, risk, or cost.

### Phase 0 — Discovery and architecture

Deliver:
- Repository and environment inspection.
- Stakeholder questions and assumptions register.
- User roles and core journeys.
- MVP scope and explicit non-goals.
- Public-site and admin information architecture.
- A comparison of suitable stack options and a recommendation.
- High-level architecture and initial data model.
- Security/privacy risk overview and data inventory outline.
- Cost categories, integration options, and operational risks.
- Acceptance criteria and milestone plan.

**Gate 0:** Do not scaffold the full application until the owner approves the stack, architecture direction, MVP scope, major recurring services, and high-impact assumptions.

### Phase 1 — Foundation and design system

Deliver:
- Repository structure and development scripts.
- Code quality tools, formatting, linting, type checks, and initial CI.
- Environment configuration and secret-handling conventions.
- Initial database connection and migration workflow, if applicable to the approved stack.
- Base layouts, design tokens, reusable components, error handling, and accessibility foundations.
- Authentication/authorization design and initial secure foundation.
- README and local setup instructions.

**Gate 1:** Review setup reproducibility, architecture boundaries, accessibility baseline, and initial security controls.

### Phase 2 — Public discovery and content

Deliver:
- Responsive home page and navigation.
- Trek listing, search/filtering, comparison where scoped.
- Trek detail page based on structured content.
- Education, FAQs, articles, contact/enquiry form.
- SEO foundations, media handling, empty/error states, and content preview.
- Fictional seed data clearly limited to non-production environments.

**Gate 2:** Review usability on mobile and desktop, content quality, accessibility, SEO, and performance before broadening the scope.

### Phase 3 — Admin content management

Deliver:
- Secure staff sign-in and role-based access.
- Admin dashboard and navigation.
- Trek, destination, itinerary, media, article, FAQ, and reusable content editing.
- Draft/review/publish lifecycle and preview.
- Audit history for important changes.
- Admin user guide and usability checks with a non-technical user.

**Gate 3:** A non-technical owner or representative must be able to complete common content tasks without developer intervention before treating the admin experience as accepted.

### Phase 4 — Enquiries, accounts, bookings, and capacity

Deliver:
- Enquiry management and follow-up.
- Customer account/portal.
- Departure and capacity management.
- Booking lifecycle/state machine.
- Manual staff-assisted booking path.
- Concurrency-safe availability and reservation handling.
- Transactional notifications in a test environment.

**Gate 4:** Booking rules, permissions, capacity concurrency, cancellation scenarios, and customer journeys must pass tests before live payments are enabled.

### Phase 5 — Payment gateway and refunds

Deliver:
- Approved provider integration in sandbox mode.
- Signed webhook verification, idempotency, reconciliation, and safe failure handling.
- Payment status and refund workflows.
- Receipts/confirmation handling as approved.
- Test evidence for success, failure, pending, duplicate events, refunds, and recovery.

**Gate 5:** Owner explicitly approves the provider, fees, policy behaviour, sandbox results, accounting/reconciliation process, and production activation. Do not switch to live mode automatically.

### Phase 6 — Safety and staff operations

Deliver:
- Restricted participant/leader views.
- Pre-departure checklists and assigned responsibilities.
- Safety notices, acknowledgement where applicable, review dates, and affected-departure notifications.
- Emergency contact access controls.
- Incident/near-miss workflow and audit trail.
- Operational cancellation/postponement workflow.

Some safety foundations and data protections must be implemented earlier when needed by the architecture; this phase completes the user-facing operational tools. Do not launch real treks based on unreviewed placeholder safety content.

**Gate 6:** Qualified operational/safety stakeholders approve the workflows, access permissions, content, and emergency procedures before they are used for live operations.

### Phase 7 — Launch readiness and production

Deliver:
- Full regression, accessibility, security, performance, and end-to-end review.
- Privacy and policy review with qualified advisers as needed.
- Production configuration, backups, restoration test, monitoring, alerts, and rollback.
- Domain and HTTPS verification.
- Staff training and admin user guide.
- Approved real content, support contact, and notification templates.
- Launch checklist and known-issues register.

**Gate 7:** Production launch requires explicit owner approval. List unresolved risks and defer launch if any critical security, payment, data integrity, or safety issue remains.

### Phase 8 — Post-launch improvement

Deliver:
- Review support issues and user feedback.
- Monitor reliability, performance, booking funnel, and admin usability.
- Prioritize improvements by user impact, risk, and effort.
- Review access permissions, dependencies, backups, and content review dates.
- Add international features only when the business has a defined need and approved requirements.

Do not build speculative features simply because they are technically interesting.

## 20. Definition of done

A feature is complete only when all applicable items are satisfied:

- It meets agreed acceptance criteria.
- It works in the intended user journey, including relevant mobile layouts.
- Validation and authorization are enforced on the server where applicable.
- Loading, empty, error, success, and recovery states are understandable.
- Relevant automated tests pass, and untested areas are disclosed.
- Accessibility has been considered and checked.
- No secrets or unnecessary sensitive data are exposed.
- Data migrations and audit requirements are handled.
- User-facing copy is clear and avoids unsupported claims.
- Documentation is updated.
- The change has been reviewed for regressions and unnecessary complexity.
- Any external service is genuinely configured or explicitly labelled as a stub.
- The final response summarizes changes, files touched, tests run, results, known gaps, and any required owner decision.

## 21. Assumptions register and unresolved business decisions

Do not treat these as settled facts. Maintain an assumptions/open-questions section in `docs/PRODUCT_REQUIREMENTS.md` and update it as decisions are made.

Initially unresolved:
- Company name, domain, branding, tone, logo, and image style.
- Exact MVP and launch date.
- Specific trekking regions, routes, and trek inventory.
- Definition of difficulty levels and fitness prerequisites.
- Batch capacity, minimum group size, booking cutoff, and seat-hold duration.
- Pricing, currency handling, taxes, invoice/receipt requirements, and discounts.
- Cancellation, rescheduling, refund, weather disruption, and operator-cancellation rules.
- Guest checkout versus mandatory customer accounts.
- Payment provider, notification providers, hosting, database, and media storage.
- Staff role matrix and account provisioning.
- Required customer/participant fields and retention periods.
- Emergency procedures, incident escalation, and safety-review owners.
- Privacy/legal review responsibilities and applicable jurisdictions.
- Backup recovery objectives and support response expectations.
- Analytics and marketing consent requirements.
- International currencies, languages, timezones, permits, and local operational requirements.

Use these rules for unknowns:
1. Ask a concise question when the answer changes architecture, safety, money, privacy, or irreversible behaviour.
2. For non-blocking decisions, document a labelled assumption and choose the simplest reversible option.
3. Use fictional sample content in local development only.
4. Never publish invented business, trek, legal, payment, or safety facts.
5. Revisit assumptions before the phase that depends on them.
6. Record owner approval and decision date for consequential decisions.

## 22. Working style for every substantial task

Before coding:
1. Restate the goal and user outcome briefly.
2. Inspect relevant files and instructions.
3. Identify dependencies, assumptions, and risks.
4. Present the smallest reasonable plan and approval gate if required.

During implementation:
1. Work in small coherent steps.
2. Follow the approved architecture and design system.
3. Add tests alongside behaviour, not as an afterthought.
4. Keep accessibility, authorization, data integrity, and error states in scope.
5. Update documentation as decisions and behaviour change.
6. Stop and ask if a new discovery invalidates an approved assumption or introduces a high-impact risk.

After implementation:
1. Inspect the diff.
2. Run relevant checks and report exact results.
3. Identify what was not tested and why.
4. Summarize changes and remaining work in plain language.
5. Ask only for decisions that are genuinely needed to proceed.

Do not dump the entire application into one response. Do not continue through an approval gate merely because a tool or coding environment permits it.

---

## 23. Gemini CLI and instruction-file compatibility

This project uses `AGENTS.md` as the desired cross-agent project instruction filename. **Do not assume every Gemini tool loads `AGENTS.md` automatically.**

- For **Gemini CLI**, the conventional project instruction file is `GEMINI.md`. Verify the behaviour of the installed CLI version and its configuration before relying on any alternate filename.
- If Gemini CLI is the primary agent, keep this `AGENTS.md` as the canonical project policy and create a root `GEMINI.md` that imports it using the import syntax supported by the installed Gemini CLI version (commonly `@./AGENTS.md`). Verify that the import is recognized; if not, maintain a concise `GEMINI.md` entry point that explicitly includes the canonical instructions without silently diverging.
- If another Gemini-powered IDE or agent is used, verify its supported instruction filenames and precedence. Follow its documented convention while keeping this file as the shared source of truth where possible.
- If the tool supports nested instruction files, use them only for genuinely local rules. Nested rules must not weaken security, privacy, safety, testing, or approval requirements in this document.
- If instruction loading is uncertain, state that uncertainty and ask before relying on the file being applied. Do not claim that the agent has read or obeyed instructions unless the tool actually loaded them.

## 24. First task when opening this repository

If the repository has no implementation yet, your first task is **Phase 0 only**.

1. Inspect the repository and confirm its current state.
2. Ask only the highest-impact missing questions; do not overwhelm the owner with every unresolved detail at once.
3. Create an initial product requirements document with confirmed facts, assumptions, and open questions.
4. Compare a small number of appropriate technology stacks for this specific project.
5. Recommend an architecture with clear trade-offs, cost categories, data flows, and security implications.
6. Propose an MVP and phased acceptance criteria.
7. Identify safety, privacy, payment, and operational risks.
8. Present the Phase 0 deliverables for review.

**Stop at Gate 0 and request approval before scaffolding the application or installing the full stack.**
