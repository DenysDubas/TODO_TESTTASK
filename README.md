# Todo List — Test Task

Simple Todo List web app built with **Laravel** (backend) and **Angular** (frontend).

## Stack
- **Backend**: Laravel 12, PHP 8.5, SQLite
- **Frontend**: Angular 19, Tailwind CSS

## Getting started

### Backend
```bash
cd backend
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve  # runs on http://localhost:8000
```

### Frontend
```bash
cd frontend
npm install
ng serve  # runs on http://localhost:4200
```

## API Endpoints
| Method | URL | Description |
|--------|-----|-------------|
| GET | /api/tasks | Get all tasks |
| POST | /api/tasks | Create a task `{ "title": "..." }` |
| DELETE | /api/tasks/{id} | Delete a task |

## Tests
```bash
cd backend
php artisan test
```
