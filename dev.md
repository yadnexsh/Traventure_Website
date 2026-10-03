# Developer Handoff Document (dev.md)

**Project:** Trek Company Platform (Traventure)  
**Current Phase:** Phase 1 (Environment Setup Complete) / Phase 2 (Database Design & Core Models)  
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

**What is completed (Milestone 1):**
- Local toolchain (PHP, Composer, Node, npm) is fully functional.
- Laravel 13 has been scaffolded.
- PostgreSQL is installed, `.env` is configured with `traventure_local`, and base migrations have run.
- Vite dependencies are installed and building.
- Local dev server successfully serves the application.

**Next Step (Milestone 2 - Database Design & Core Models):**
- Implement database migrations for treks, departures, customers, reservations, and capacity allocations based strictly on `docs/DATABASE_SCHEMA.md`.
- Build corresponding Eloquent models and define relationships.
- Do NOT start building UI or authentication until the core database structure is robust.

## 5. Important Directory Map

- `AGENTS.md` -> MUST READ. Contains the strict working agreement and behavioral constraints for all AI agents.
- `docs/milestones.md` -> The project roadmap (M0 to M11).
- `docs/DATABASE_SCHEMA.md` -> The confirmed conceptual data model.
- `docs/BOOKING_AND_PAYMENT_RULES.md` -> Details on capacity limits, online holds, and offline reservations. 

*(If you are an AI reading this, review `AGENTS.md` immediately, check the current environment, and verify the `php -v` and `composer --version` status before proposing new code).*
 