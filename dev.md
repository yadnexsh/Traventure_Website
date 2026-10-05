# Developer Handoff Document (dev.md)

**Project:** Trek Company Platform (Traventure)  
**Current Phase:** Milestone 10 (UI & Visual Design)  
**Last Updated:** October 2026  

This document provides a high-level summary of the project state, architectural decisions, and next steps. For detailed agent instructions and boundaries, strictly follow `AGENTS.md`.

---

## 1. Project Overview

We are building a comprehensive web platform for an India-based trekking company. The system supports:
- **Trek Discovery:** Public-facing pages to explore treks, itineraries, pricing, and availability.
- **Online Booking:** Customers can register, hold seats for 15 minutes, and book (payment integration deferred).
- **Admin/Offline Booking:** The business admin handles customer calls, recording "offline bookings" in the admin panel and manually allocating seats without requiring customer accounts.
- **Expression of Interest:** A lightweight form for users to signal interest in a full or unscheduled batch without consuming physical capacity.

## 2. Tech Stack

- **Backend / Framework:** Laravel (PHP)
- **Database:** PostgreSQL
- **Frontend:** Server-Rendered Blade Templates (Monolith approach for simplicity)
- **Deployment (Planned):** Laravel Forge + DigitalOcean (India region)

## 3. Core Business Logic & Invariants

The most critical and complex part of the system is the **Capacity and Booking Engine**:

1. **Separation of Concerns:** 
   - A `Reservation` is a container for a customer's trip (price, customer record, payment status).
   - A `SeatAllocation` is the actual physical lock on the capacity of a `Departure`.

2. **Concurrency & Locking:** 
   - The PostgreSQL database is the absolute source of truth.
   - We use row-level locking (`DB::transaction` with `lockForUpdate()`) to prevent race conditions when two customers attempt to book the final seat simultaneously.

3. **Capacity Formula:**
   ```text
   Online Availability = Total Capacity - Unused Offline-Reserved Capacity - Active Offline Allocations - Active Online Allocations
   ```
   - `total_capacity`: The absolute physical limit for the trek batch.
   - `unused_offline_reserved_capacity`: Seats hidden from the public, specifically saved for the admin to allocate manually.
   - **Hold Expiry:** Online holds (`SeatAllocation`) have an `expires_at` timestamp. They dynamically stop consuming capacity after 15 minutes without needing a scheduled cleanup task. Offline allocations (created by the admin) have no expiry and must be released manually.

4. **Account Linking is Deferred:** 
   - Customers must verify their email to book online. 
   - Admin-recorded offline bookings use a lightweight `CustomerRecord` and do *not* require a user account.
   - The system does *not* automatically merge accounts based on matching emails or phone numbers.

## 4. Current Status & Next Steps

**What is completed:**
- All Phase 0 architectural planning and business rule validation.
- Extensive documentation in the `docs/` directory (`PRODUCT_REQUIREMENTS.md`, `ARCHITECTURE.md`, `DATABASE_SCHEMA.md`, `milestones.md`, etc.).

**What is completed (Milestones 1-7):**
- **M1 (Project Setup):** Laravel scaffolded, PostgreSQL configured (`traventure_local`), Vite installed, and local dev server running.
- **M2 (Database & Models):** Eloquent models and migrations created for Treks, Departures, CustomerRecords, Reservations, and SeatAllocations. Strict PostgreSQL `CHECK` constraints added to prevent negative capacities. Tested schema integrity.
- **M3 (Public Website):** Created responsive blade layout, home page, trek index, and trek detail views. Fully implemented the documented capacity math in `Departure::getOnlineAvailabilityAttribute()`, automatically ignoring expired online holds.
- **M4 (Authentication & Customer Accounts):** Integrated Google OAuth socialite login and basic local auth registration logic, fully tested and securely configured.
- **M5 (Booking Engine):** Concurrency-safe seat allocation, temporary 15-minute online holds, confirmed reservations, and postgres transaction locking implemented.
- **M6 (Admin Dashboard & Offline Bookings):** Trek/Departure management CRUD, Audit Logs, and Seat Releases logic built with Tailwind UI for admins.
- **M7 (Trek Interest Tracking):** Public "Expression of Interest" form when a departure is sold out. Safely captures normalized emails, avoids duplicates using DB unique constraints & `firstOrCreate`, and provides admin dashboard view.
- **M8 (Testing, Security and Accessibility):** System-wide regression testing for booking conflicts, capacity boundaries, and permissions. Validated privacy, accessibility, and mobile layout usability.
- **M9 (Production-Like Local Demo Environment):** Provisioned local demo environment with restricted Staff role, demo accounts, realistic test data, and verified safe local database backup/restore procedures.

**Next Step (Milestone 10 - UI & Visual Design):**
- Turn the functional application into a complete, polished Traventure website.
- Establish final visual direction, typography, colors, and responsive design across all pages.

## 5. Important Directory Map

- `AGENTS.md` -> MUST READ. Contains the strict working agreement and behavioral constraints for all AI agents.
- `docs/milestones.md` -> The project roadmap (M0 to M11).
- `docs/DATABASE_SCHEMA.md` -> The confirmed conceptual data model.
- `docs/BOOKING_AND_PAYMENT_RULES.md` -> Details on capacity limits, online holds, and offline reservations. 

*(If you are an AI reading this, review `AGENTS.md` immediately, check the current environment, and verify the `php -v` and `composer --version` status before proposing new code).*