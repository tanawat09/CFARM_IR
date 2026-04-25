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

## Portainer Deployment

Portainer should deploy this project with `docker-compose.portainer.yml`, not `docker-compose.yml`.
The Portainer stack file is image-only, so it avoids the remote `compose build` path that can fail with BuildKit/HTTP2 errors.

### 1. Build and push the images from a machine that has Docker

```powershell
.\scripts\build-portainer-images.ps1 -Registry ghcr.io/your-org -Tag v1 -Push
```

This script prints the exact `APP_IMAGE` and `WEBSERVER_IMAGE` values to paste into Portainer.

### 2. Create the stack in Portainer

- Use `docker-compose.portainer.yml`
- Set stack environment variables from `portainer.env.example`
- At minimum, set:
  - `APP_IMAGE`
  - `WEBSERVER_IMAGE`
  - `APP_KEY`
  - `DB_PASSWORD`
  - `DB_ROOT_PASSWORD`

### 3. Recommended production values

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain
APP_PORT=2019
DB_DATABASE=cfarm_ir
DB_USERNAME=itadmin
DB_PASSWORD=replace-with-strong-password
DB_ROOT_PASSWORD=replace-with-strong-root-password
```

If you deploy the stack from a Git repository in Portainer, point the compose path to `docker-compose.portainer.yml`.

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
