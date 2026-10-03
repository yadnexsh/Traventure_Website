# Trekking Company Website

This repository contains the source code and documentation for a comprehensive trekking platform, encompassing a public-facing website and a private staff admin panel.

## Architecture & Tech Stack

The application is built as a maintainable **modular monolith**. 
- **Framework:** Laravel (PHP)
- **Database:** PostgreSQL
- **Hosting (Planned):** Laravel Forge + VPS (e.g., DigitalOcean in Bangalore region for India-first latency).

## Project Documentation

All architectural decisions, product requirements, and business rules are documented in the `docs/` directory. **You must review these documents before contributing.**

- [Product Requirements](docs/PRODUCT_REQUIREMENTS.md)
- [Architecture](docs/ARCHITECTURE.md)
- [Database Schema](docs/DATABASE_SCHEMA.md)
- [Design System](docs/DESIGN_SYSTEM.md)
- [Security & Privacy](docs/SECURITY_AND_PRIVACY.md)
- [Safety Operations](docs/SAFETY_OPERATIONS.md)
- [Booking & Payment Rules](docs/BOOKING_AND_PAYMENT_RULES.md)
- [Testing Strategy](docs/TESTING_STRATEGY.md)
- [Admin User Guide](docs/ADMIN_USER_GUIDE.md)

## Core Business Logic Highlights

- **Capacity is King:** The database (PostgreSQL) is the absolute source of truth for departure capacity. We use `DB::transaction()` and row-level locking to serialize capacity allocations and prevent overbooking.
- **Seat Allocations vs. Reservations:** A reservation is merely the container for a customer's trip. A `SeatAllocation` is the actual physical lock on a seat.
- **Online vs. Staff Allocations:** Online holds expire strictly in 15 minutes. Staff allocations do not expire and immediately reduce public capacity.
- **Data Privacy:** Customer health and emergency data are minimized and heavily restricted via RBAC.

## Local Setup (Coming Soon)

*(Instructions for scaffolding Laravel, running migrations, and seeding the database will be added here once Phase 1 begins).*
