# Design System

**Status:** Initial direction — visual identity and tokens are not approved  
**Audience:** Public trekking website, customer portal, admin panel, and staff views.

## 1. Design goals

- Trustworthy, calm, outdoors-oriented, and easy to navigate.
- Clear information hierarchy; avoid a generic travel-template appearance.
- Mobile-first and accessible.
- The admin interface prioritizes task completion and clarity over decorative effects.
- Public and admin experiences share foundational tokens and components but may use different layouts.

## 2. Visual direction

Explore an original visual identity using natural, restrained colors and strong readable typography. Do not finalize brand colors, logo, typefaces, or image treatment until the owner reviews visual concepts.

Avoid:
- Low-contrast text over scenic images.
- Text embedded in images for essential information.
- Excessive animation, parallax, or autoplay video.
- Fake urgency, misleading scarcity, and intrusive pop-ups.
- Inconsistent button meanings or color-only status indicators.

## 3. Tokens to define

Document approved values for:
- Brand, neutral, surface, text, border, focus, success, warning, and error colors.
- Typography family, sizes, weights, line heights, and readable line lengths.
- Spacing scale, layout widths, breakpoints, and grid.
- Border radius, shadows, elevation, and focus ring.
- Icon style, image ratios, crop behaviour, and motion preferences.

Use semantic tokens rather than scattering raw values across components.

## 4. Core components

Create and document reusable, accessible components for:
- Header, navigation, footer, breadcrumbs.
- Buttons, links, badges/status labels, cards, tabs, dialogs, tooltips.
- **"I'm interested in this batch" action:** A distinct, low-friction button/form for expression of interest without implying a confirmed booking.
- Text fields, select controls, checkboxes, radio groups, date/time selection, text areas, upload controls.
- Search, filters, sorting, trek comparison, pagination.
- Trek card, trek facts, itinerary day, packing list, price breakdown, availability panel.
- Alerts, inline validation, toast/status messages, empty/loading/error states.
- Admin tables, bulk actions, editor forms, preview, audit history, confirmation dialogs.
- Responsive image/gallery components.

Each interactive component needs hover, focus, disabled, loading, error, and success states where relevant.

## 5. UX rules

- Show key trek facts early: duration, difficulty, season, prerequisites, price, departure dates, and availability.
- Keep prices, capacity, and booking state consistent throughout the journey.
- The public website must show accurate availability but must **never** disclose whether a seat was booked online or allocated by staff.
- Explain why information is requested, especially emergency or participant information.
- Preserve non-sensitive form entries when safe after validation errors.
- Use plain language and helpful next steps.
- Require confirmation for destructive admin actions (like releasing a staff reservation) and offer undo where practical.
- Make table filters, forms, and navigation usable on touch devices.

## 6. Accessibility

Target WCAG 2.2 AA and verify the applicable criteria during implementation.

- Semantic HTML and correct heading structure.
- Keyboard access and visible focus.
- Accessible names, labels, instructions, and validation announcements.
- Sufficient contrast and no color-only meaning.
- Meaningful image alt text; decorative images should be ignored by assistive technology.
- Reduced-motion support.
- Accessible dialogs, menus, date pickers, tables, and form errors.
- Manual keyboard checks plus automated accessibility testing.

## 7. Responsive and performance rules

- Design from small screens upward.
- Prevent horizontal overflow at common viewport sizes.
- Optimize image sizes and use responsive sources.
- Avoid layout shifts; reserve image dimensions.
- Test key journeys on realistic mobile conditions.

## 8. Admin usability acceptance

Ask a non-technical representative to test these tasks:
1. Create a draft trek and publish it.
2. Create a departure with specific total capacity and staff-reserved seats.
3. Manually allocate a seat for a customer without an account.
4. Release a staff-allocated seat.
5. Review Expressions of Interest for a specific batch.
6. Locate the audit trail.
