# Design System

**Status:** Confirmed Visual Direction (M10.1)  
**Audience:** Public trekking website, customer portal, admin panel, and staff views.

## 1. Design Goals

- Trustworthy, calm, outdoors-oriented, and easy to navigate.
- Clear information hierarchy; avoid a generic travel-template appearance.
- Mobile-first and accessible.
- The admin interface prioritizes task completion and clarity over decorative effects.
- Public and admin experiences share foundational tokens and components but use different layouts.

## 2. Visual Direction

Traventure uses a restrained, modern trekking/outdoor visual language. The design communicates adventure, outdoors, reliability, safety, professionalism, and approachability.

Avoid:
- Low-contrast text over scenic images.
- Text embedded in images for essential information.
- Excessive animation, parallax, or autoplay video.
- Fake urgency, misleading scarcity, and intrusive pop-ups.
- Inconsistent button meanings or color-only status indicators.
- Overly corporate banking aesthetics or overly playful startup aesthetics.
- Excessive glassmorphism, rounded cards, or deep shadows.

## 3. Brand Palette & Color Hierarchy

The following colors are defined in `app.css` as Tailwind v4 `@theme` variables:

*   **Primary: `#438D98`** (`--color-brand-primary`)
    *   **Role:** Dominant brand identity.
    *   **Usage:** Brand surfaces, navigation, selected states, major sections, footer, prominent UI elements.
*   **Accent: `#31A8CC`** (`--color-brand-accent`)
    *   **Role:** Selective high-emphasis accent.
    *   **Usage:** Important CTAs, booking emphasis, active/high-priority states. Must be used sparingly so it retains its impact.
*   **Dark: `#000000`** (`--color-brand-dark`)
    *   **Role:** Strong contrast and absolute darkness.
    *   **Usage:** Sparingly for very strong text emphasis or dark mode elements. Derived neutrals (e.g., `text-gray-900`) will be used for standard body text.
*   **Soft: `#FDF2F7`** (`--color-brand-soft`)
    *   **Role:** Soft supporting surface.
    *   **Usage:** Subtle background tones, section highlights, and muted cards. Not for the dominant website background (which should remain mostly white/neutral).
*   **Secondary: `#98806F`** (`--color-brand-secondary`)
    *   **Role:** Secondary supporting tone.
    *   **Usage:** Supporting neutral accents where appropriate. Does not compete with Primary.

The majority of the interface must have comfortable neutral space (white or light gray) to prevent an overwhelmingly colorful UI.

## 4. Typography

*   **Font Family:** `Plus Jakarta Sans` (sans-serif). A highly readable, premium editorial web font suited for outdoor travel and professional interfaces.
*   **Headings (H1-H3):** Bold, clean hierarchy for visual punch without looking cartoonish.
*   **Body:** Regular weight, generous line-height (`leading-relaxed`) for maximum readability.
*   **Small/Metadata:** Smaller text sizes (`text-sm`, `text-xs`) with medium weight and muted colors (`text-text-muted`) to establish hierarchy without competing with primary content.

## 5. Layout & Spacing

*   **Max-Width:** `max-w-7xl` for standard public pages to ensure content doesn't stretch too wide on ultrawide monitors.
*   **Spacing Rhythm:** Generous visual breathing room.
    *   `py-12` to `py-24` for distinct vertical sections.
    *   `p-6` or `p-8` for prominent cards.
    *   `gap-6` or `gap-8` for standard grid gaps.
*   **Responsive:**
    *   **Mobile:** Stacked blocks, full-width buttons, accessible touch targets (min 44px height).
    *   **Tablet:** 2-column grids, adjusted padding.
    *   **Desktop:** 3-4 column grids, horizontal navigation, expansive hero sections.

## 6. Component Visual Language (Updated M10.2.1)

*   **Buttons:** Standard height (`h-11`), slight border radius (`rounded-md`), clear focus rings (`focus:ring-2 focus:ring-offset-2 focus:ring-brand-primary`). Primary buttons use `#438D98`. Avoid playful pill shapes (`rounded-full`).
*   **Cards:** Clean flat borders (`border-border-subtle`), moderate radius (`rounded-lg`), very soft or no shadows by default to avoid a "floating game card" look.
*   **Forms:** Accessible borders, clear labels, distinct error states (red borders/text + aria attributes).
*   **Badges:** Status badges use distinct background/text combinations and icons. Do not use excessive pills for decoration.
*   **Photography:** Emphasize real outdoor photography (mountain trails, campsites, real trekking groups). Avoid overly saturated game-like imagery, excessive gradients over photos, or low-contrast text overlays.

## 7. Public vs. Admin Differences

*   **Public:** Visual, welcoming, spacious, adventurous, booking-oriented. Generous padding and prominent imagery.
*   **Customer Area:** Simple, clear, trustworthy, task-oriented.
*   **Admin/Staff:** Efficient, information-dense, operational, easy to scan. Uses the same tokens (colors, typography) but in a more compact layout (e.g., `py-2`, `px-4`, smaller font sizes in tables) to maximize screen real estate.

## 8. Accessibility

*   **Contrast:** Brand colors must be checked for WCAG 2.2 AA contrast. For example, white text on `#31A8CC` or `#438D98` must meet a 4.5:1 ratio for normal text or 3.1 for large text. If a brand color fails contrast for body text, use a darker derivative or `#000000`.
*   **Focus States:** All interactive elements must have highly visible focus rings (`focus:ring`).
*   **Color-Only:** Status (Full, Available) must be communicated with text or icons alongside color.
*   **Touch Targets:** Minimum 44x44px clickable areas on mobile devices.
*   **Forms:** Explicit labels, `aria-invalid` on errors, `aria-describedby` for validation messages.

## 9. Deferred Design Decisions & Assets (M10.2.2)

*   **Temporary Imagery:** Currently, temporary development imagery lives under `resources/media` and is compiled via Vite. Permanent media management, image naming, scaling, and database mapping are deferred to a later phase.
*   **Imagery Style:** Real owner-provided photography is strongly preferred. Imagery should use consistent aspect ratios and evoke premium outdoor travel rather than gaming/SaaS aesthetics.
*   **Upcoming Departures Component:** The current departure card has a cleaned-up structural UI to ensure consistent typography and spacing. However, a final visual redesign is deferred pending a provided Figma reference.
*   **Specific HTML structure:** Blade components may still evolve.
*   **Customer Booking UX:** Multi-step forms deferred.
*   **Admin UI:** Actual UI implementations of Admin DataTables deferred.
