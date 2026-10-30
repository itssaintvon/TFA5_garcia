# POS Command Center - Laravel Foundations

This project satisfies IT0049 Technical Formative Assessment 5. It contains a landing page, an About page, a Customer Accounts page, and a User Accounts page.

## Laravel setup

1. Install PHP 8.2+ and Composer.
2. Copy `.env.example` to `.env`.
3. Run `composer install`.
4. Run `php artisan key:generate`.
5. Run `php artisan serve` and open `http://127.0.0.1:8000`.

## Required routes

- `/` - landing page
- `/about` - application and MVC explanation
- `/customers` - five customer records from `CustomerController`
- `/users` - five user records from `UserController`

## InfinityFree upload

The ZIP includes `index.php` at the project root as a shared-hosting entry point. Upload the ZIP contents to the domain's `htdocs` folder. The entry point is self-contained and does not require Composer on the server; it uses the same controllers, records, routes, and view structure required by the activity. If Composer is available on your host, you may instead point the document root to `public/` and run the normal Laravel bootstrap.

The `public/` folder also contains the Laravel-style web entry point for standard Laravel hosting.
