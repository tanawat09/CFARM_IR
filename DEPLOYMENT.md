# CFARM IR Platform - Deployment Guide

## Prerequisites
- PHP 8.2+
- Composer
- Node.js & npm
- MySQL 8.0+
- Docker & Docker Compose (optional)

---

## Local Development Setup

```bash
# 1. Clone the project
git clone <repo-url> cfarm_ir
cd cfarm_ir

# 2. Install PHP dependencies
composer install

# 3. Install Node dependencies
npm install

# 4. Environment setup
cp .env.example .env
php artisan key:generate
```

Edit `.env` with your database credentials:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3308
DB_DATABASE=cfarm_ir
DB_USERNAME=your_db_user
DB_PASSWORD=your_strong_db_password
ALLOW_PUBLIC_REGISTRATION=false
ADMIN_PASSWORD=generate_a_unique_admin_password
EDITOR_PASSWORD=generate_a_unique_editor_password
SET_API_KEY=your_external_api_key_if_needed
```

```bash
# 5. Run migrations & seed
php artisan migrate
php artisan db:seed

# 6. Storage link
php artisan storage:link

# 7. Build frontend
npm run build

# 8. Run development server
php artisan serve
```

Visit: `http://localhost:8000`

---

## Docker Deployment

```bash
# 1. Build & start containers
docker-compose up -d --build

# 2. Install dependencies inside container
docker exec cfarm_ir_app composer install
docker exec cfarm_ir_app php artisan key:generate
docker exec cfarm_ir_app php artisan migrate --seed
docker exec cfarm_ir_app php artisan storage:link

# 3. Build frontend
npm install && npm run build
```

Services:
| Service     | URL                    |
|-------------|------------------------|
| App         | http://localhost:8080   |
| phpMyAdmin  | http://localhost:8081 (start with `docker compose --profile debug up`) |

---

## Admin Access

```
URL:      /login
Email:    admin@cfarm.co.th
Password: value from ADMIN_PASSWORD
```

---

## API Endpoints

| Method | Endpoint                   | Description           |
|--------|----------------------------|-----------------------|
| GET    | /api/v1/news               | List published news   |
| GET    | /api/v1/news/{slug}        | Get news by slug      |
| GET    | /api/v1/financial-reports  | List financial reports |
| GET    | /api/v1/events             | List events           |
| GET    | /api/v1/events/upcoming    | Upcoming events       |
| GET    | /api/v1/documents          | List documents        |

---

## Production Checklist

- [ ] Set `APP_ENV=production` and `APP_DEBUG=false`
- [ ] Rotate any credentials previously committed to the repository
- [ ] Run `php artisan config:cache`
- [ ] Run `php artisan route:cache`
- [ ] Run `php artisan view:cache`
- [ ] Run `npm run build`
- [ ] Set up SSL/HTTPS
- [ ] Configure backup strategy
- [ ] Set proper file permissions
