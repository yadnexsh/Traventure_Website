# M10.2.5 — Homepage Concept A: Premium Outdoor Editorial + Trek Discovery

## Overview
Concept A provides a strong editorial identity for Traventure. It focuses on large editorial photography, strong trek discovery, clear information hierarchy, and a spacious layout. It avoids feeling like a SaaS dashboard or gaming interface, relying heavily on the Plus Jakarta Sans typography, minimal borders, and a calm brand palette (`#438D98`).

## Refinement: Interactive Trek Discovery
The static placeholder cards in the "Your Next Adventure" section were fully transformed into a **compact, interactive Trek Discovery tool** powered by Alpine.js. 

### Key Interactions & Behavior
1. **Interactive Filters**: 
   - Users can seamlessly filter all published treks directly from the homepage without full page reloads.
   - Filters are styled as compact, premium editorial chips instead of large SaaS-like cards.
2. **Supported Filters (Honest Data Mapping)**:
   - **By Month**: Uses existing `start_time` data from `departures` relationship.
   - **By Difficulty**: Directly maps to the `difficulty` field on the `Trek` model.
   - **By Season (Removed)**: Intentionally omitted because neither the `Trek` nor `Departure` models currently store seasonal metadata. Faking this logic was avoided in favor of honest data representation. Adding a season filter will require a future schema/tagging update.
3. **Responsive Cards**:
   - Filtered results dynamically appear in a grid layout directly below the controls, maintaining visual continuity.
   - If no treks match a selected combination, a tasteful empty state is shown ("No treks match this selection yet.") along with a "Clear Filters" button.

### Responsive Design
- **Desktop (1440px / 1280px)**: The filter controls sit neatly side-by-side, occupying minimal vertical space so the trek results immediately draw the eye.
- **Tablet (768px)**: The layout stacks naturally, ensuring touch targets remain comfortable.
- **Mobile (375px)**: The month filters utilize a smooth horizontal scrolling container (`overflow-x-auto snap-x`) to prevent an overwhelming vertical stack of 12 buttons. Zero horizontal page overflow exists.

### Technical Constraints Respected
- **No backend logic changed**: `PublicTrekController@home` was only updated to pass the full collection of published treks (with active departures) to the view.
- **No database changes**: Migrations and schemas remain untouched.
- **Concept B Preservation**: All modifications were strictly isolated to the Concept A working tree/branch (`27-m1024-traventure-homepage-editorial-outdoor-travel-redesign`).
