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
- **Online vs. Offline Allocations:** Online holds expire strictly in 15 minutes. Admin offline allocations do not expire automatically.
- **Data Privacy:** Customer health and emergency data are minimized and heavily restricted via RBAC.

## Local Setup

### 1. Requirements
- PHP 8.4+ and Composer (e.g., via Laravel Herd)
- PostgreSQL 18+

### 2. Configure Environment
1. The `.env` file should be configured with PostgreSQL settings:
   ```ini
   DB_CONNECTION=pgsql
   DB_HOST=127.0.0.1
   DB_PORT=5432
   DB_DATABASE=traventure_local
   DB_USERNAME=postgres
   DB_PASSWORD=your_password
   ```

### 3. Create Database
Using the PostgreSQL command line (psql) or a tool like pgAdmin, connect using your `postgres` user password and run:
```sql
CREATE DATABASE traventure_local;
```

### 4. Run Application
Ensure dependencies are installed and the application is running:
```bash
composer install
php artisan migrate
php artisan serve
```

### 5. Verify Health
Open `http://localhost:8000/health` to confirm the application and database are connected successfully.
