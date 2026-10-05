M0 — Development Environment Setup

Current blocker

Install and verify PHP, Composer and PostgreSQL on Windows. Confirm all tools work in the terminal.

M1 — Laravel Application Setup

Create the Laravel project, configure PostgreSQL, add basic health checks and document local setup.

M2 — Database Design and Core Models

Implement migrations, relationships, constraints and models for treks, departures, customers, reservations and capacity allocations.

M3 — Public Website and Trek Discovery

Build responsive pages for the home page, trek listings, trek details, departure dates, pricing and public availability.

M4 — Customer Accounts

Implement registration, email verification, login, logout, password recovery and secure session handling.

M5 — Booking and Capacity Engine

Build concurrency-safe seat allocation, temporary 15-minute online holds, confirmed reservations and accurate availability calculations.

M6 — Admin Dashboard and Offline Bookings

Manage treks, departures, capacity, offline customer bookings, seat releases, and reservation records through a protected admin area.

M7 — Trek Interest and Demand Tracking

Let visitors express interest in a full departure. Show interest counts and contact details to the admin without reserving seats.

M8 — Testing, Security and Accessibility

Test booking conflicts, capacity boundaries, permissions, validation, privacy, mobile layouts and accessibility.

------------------------------------------------
OLD

M9 — Private Staging Deployment

Choose hosting, deploy securely, configure environment variables, database backups, logs and private access. Verify the full application in staging.

M10 — Payment Integration

Future phase

Integrate Razorpay, verify payment status using trusted server-side confirmation, handle webhooks, failures, refunds and reconciliation.

M11 — Production Launch

Complete production security checks, domain and HTTPS setup, monitoring, recovery procedures and launch validation.


----------------------------------------------------

NEW
M9 — Production-Like Local Demo Environment

Build a localhost-only environment that behaves like the eventual live website.

Production-like security and Laravel configuration
Admin and Staff roles/accounts
Demo Customer accounts and realistic data
Logging and error handling
Local database backup/restore verification
Data privacy and encryption/security checks
Full end-to-end workflow verification
No public hosting or paid infrastructure
M10 — UI & Visual Design

Turn the functional application into a complete, polished Traventure website.

Establish final visual direction
Homepage and trek discovery
Trek detail and availability UI
Booking/customer experience
Customer dashboard
Admin/Staff panels
Responsive mobile/tablet/desktop design
Accessibility-preserving implementation
Consistent typography, colors, spacing, components and interactions
M11 — Payment Readiness

Prepare payment functionality without spending money or enabling live payments.

Razorpay integration architecture
Sandbox/test integration where available
Server-side payment verification
Webhook verification and duplicate handling
Payment failures/cancellations
Refund and reconciliation states
Payment audit trail
Keep live payments disabled until owner approval and merchant setup

Future after M11: Owner approval → paid infrastructure → production deployment → live Razorpay → final production security/launch checks.