# Product Requirements

**Status:** Confirmed Baseline Requirements  
**Market:** India first; international expansion considered in the design  
**Business model:** Trek discovery and education, hybrid online bookings and admin-managed offline bookings.

## 1. Product vision

Create a trustworthy, accessible trekking website that helps people understand a trek, assess whether it may suit their experience and preparation, enquire or book, and manage trip information. Provide a simple admin panel so the non-technical owner can update content and operate bookings without coding.

The site may use established trekking websites as high-level UX references, but must use an original brand, original content, and properly licensed media.

## 2. Goals

- Make trek details and prerequisites easy to find and compare.
- Help visitors prepare responsibly through useful educational content.
- Support both admin-recorded offline bookings and online bookings with a payment gateway (future).
- Prevent overbooking and keep prices, availability, and booking status consistent through strict database controls.
- Let the admin manage treks, batches, content, enquiries, bookings, and updates.
- Protect personal and sensitive information with data minimization.
- Make core flows work well on mobile and meet an accessibility target of WCAG 2.2 AA, subject to verification.
- Keep the architecture maintainable for a small team and reasonably priced to operate using Laravel.

## 3. Scope

### Public website
- Home page, navigation, trek listing/search/filtering.
- Trek detail pages with structured content, batch availability, and an "I'm interested in this batch" feature.
- Trek preparation guides, FAQs, articles, and contact/enquiry forms.
- Clear prices, inclusions/exclusions, prerequisites, cancellation terms, and booking status.
- SEO basics: stable URLs, metadata, sitemap, structured data where appropriate, and internal links.

### Customer portal
- Secure account registration and email verification (mandatory for online booking).
- Secure account recovery (expiring single-use tokens, generic responses, rate limiting).
- View own online bookings, status, and trip updates.
- Submit required booking/participant information.

### Admin and operations
- Dashboard, trek/destination/batch editing, itinerary and media management.
- Departure capacity configuration (total approved capacity and unused offline-reserved seats).
- Draft/review/publish content workflow.
- Enquiry, expression of interest, and booking management.
- Admin-recorded offline seat allocation (no customer account required) with immediate capacity reduction.
- Explicit release of offline-allocated seats with a choice of returning them to the offline-reserved pool or the online availability pool.
- Blocked reduction of total departure capacity below currently active allocations.
- Restricted safety notices, assigned departure information, and incident workflows.
- Audit history for sensitive actions.

## 4. Out of scope for this phase

- Native iOS/Android apps.
- Complex multi-country tax/accounting.
- Multiple currencies/languages.
- AI-based medical/fitness eligibility decisions.
- Microservices.
- Razorpay payment gateway integration (deferred to a future phase).
- Online automated refunds (deferred).
- Waitlists, minimum group-size rules, and group bookings (deferred).
- Secure workflows for linking offline reservations to customer accounts (deferred).

## 5. Core user journeys

1. **Discovery:** Visitor discovers a trek, checks difficulty, dates, price, prerequisites, and preparation information.
2. **Expression of Interest:** Visitor submits an "I'm interested in this batch" form. The admin views this to gauge demand without it consuming capacity.
3. **Online Booking (Future Payment):** Customer registers/logs in, verifies email, selects a departure. The system atomically locks capacity for a 15-minute checkout hold. (Payment flow to be added later).
4. **Offline Booking:** A customer calls. The admin opens the panel, records the booking, and allocates seats directly (no customer account required). This immediately deducts from the unused offline-reserved pool or general capacity. Payment is handled entirely outside the website.
5. **Customer Management:** Customer views online bookings and trip updates in their portal. Offline bookings remain fully managed via the admin panel.
6. **Operations:** Trek leader sees only the operational information needed for assigned departures.
7. **Safety:** Authorized staff publish a safety notice and notify affected participants using approved procedures.

## 6. Content requirements

A trek may include name, slug, region, duration, difficulty, altitude, distance, season, day-by-day itinerary, fitness prerequisites, packing list, weather variability, known risks, transport, accommodation, meals, inclusions/exclusions, price, permits, FAQs, images and image rights, source/review date, and publication status.

## 7. Non-functional requirements

- **Architecture:** Laravel Monolith with PostgreSQL.
- **Mobile-first:** Responsive experience.
- **Accessibility:** Semantic UI, keyboard navigation, contrast, labels, and error handling (WCAG 2.2 AA).
- **Security:** Secure authentication, server-side authorization, validated inputs, rate limiting, secure secrets, and protected sensitive records.
- **Concurrency:** Strict database transactions and row-level locking for capacity management.
- **Testing:** Automated tests for booking, capacity races, permissions, and key journeys.
- **Operations:** Logging, monitoring, and database backups with tested restoration.

## 8. Success measures
Targets: successful enquiry completion, seamless online seat holds without overbooking, admin task completion without developer help, mobile performance, accessibility compliance, and uptime.
