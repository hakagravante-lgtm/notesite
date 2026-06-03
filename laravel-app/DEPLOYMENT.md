# Deployment Guide

## 1. Host requirements
- PHP 8.0+
- Composer
- MySQL or MariaDB
- Write access to storage/ and bootstrap/cache/

## 2. Upload the project
Upload the contents of the laravel-app folder to your hosting account.

## 3. Set the web root
Set the public web root to:
- /public

If your host uses a folder structure like public_html, point it to:
- public_html/laravel-app/public

## 4. Fill in production values
Use the values in .env and replace:
- APP_URL=https://your-domain.com
- DB_HOST=localhost
- DB_DATABASE=your_database_name
- DB_USERNAME=your_db_user
- DB_PASSWORD=your_db_password

## 5. Install dependencies
Run:
- composer install --optimize-autoloader --no-dev

## 6. Run migrations
Run:
- php artisan migrate --force

## 7. Cache for production
Run:
- php artisan config:cache
- php artisan route:cache
- php artisan view:cache

## 8. Fix permissions
Make sure storage/ and bootstrap/cache/ are writable.

## 9. Common fixes
- 500 error: check APP_KEY, DB credentials, storage permissions
- blank page: check web root points to public/
- database error: verify DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD
