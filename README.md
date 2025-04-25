# 🌐 Translation Management API (Laravel)

This project is a scalable and performant **Translation Management Service** built with Laravel. It supports localization, tagging, API access, and JSON export for frontend apps. Designed to be PSR-12 compliant and SOLID-principled.

---

## 🚀 Features

- Store translations for multiple locales (e.g., `en`, `fr`, `es`)
- Tag translations for context (e.g., `web`, `mobile`, `desktop`)
- Full CRUD API with token-based authentication (Laravel Sanctum)
- JSON export endpoint optimized for performance
- Pagination and search by locale, key, value, or tags
- Factory seeding for 100k+ records
- Fully tested with Pest (unit, feature, and performance tests)
- Docker-ready and testable with `.env.testing`

---

## 🧰 Tech Stack

- Laravel 12
- Sanctum for API auth
- Pest for testing
- MySQL / SQLite (for testing)
- Eloquent, Migrations, Factories, Seeders
- PSR-12 code style
- OpenAPI-ready (Swagger)

---

## ⚙️ Installation

```bash
git clone https://github.com/your-username/translation-api.git
cd translation-api

cp .env.example .env
composer install
php artisan key:generate

Setup MySQL
DB_DATABASE=transaltion_management_service
DB_USERNAME=root
DB_PASSWORD=

Run migrations and seed:
php artisan migrate --seed

Run Tests (Pest + SQLite / MySQL)
Setup .env.testing:

APP_ENV=testing
DB_CONNECTION=mysql
DB_DATABASE=transaltion_management_service_testing
DB_USERNAME=root
DB_PASSWORD=

php artisan test

Authentication
Register via POST /api/register

Login via POST /api/login

Use the returned token for Authorization: Bearer <token>

All /api/translations/* routes are protected.

API Endpoints
Method	URI	Description
GET	/api/translations	List translations (with filters)
POST	/api/translations	Create a new translation
PUT	/api/translations/{id}	Update translation
GET	/api/translations/{id}	View a translation
GET	/api/translations/export/{locale}	Export translations as JSON

Seed 100K+ Records (for scalability testing)
php artisan db:seed --class=TranslationSeeder
