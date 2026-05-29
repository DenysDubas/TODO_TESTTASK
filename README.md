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

## Tests
```bash
cd backend
php artisan test
```
