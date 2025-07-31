# Simple TODO List

## Requirements
- git
- Docker & Docker Compose
- Node.js 20+
- Free ports `8081` and `8080` 

## Installation
- `git clone https://github.com/MartinHanzl/ecomail.git`

### Server
- `cd ecomail/server`
- `cp .env.example .env`
- to .env file add/edit following databse connection parameters
```
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=secret
```
- `docker-compose up -d --build`
- `docker exec -it laravel-app php artisan serve --host=0.0.0.0 --port=8000`
- `docker exec -it laravel-app php artisan migrate`
- `docker exec -it laravel-app php artisan key:generate`
- `docker exec -it laravel-app php artisan optimize:clear`
- open `http://localhost:8000` in your browser for accessing the server API
- open `http://localhost:8080` in your browser for phpmyadmin

### Client
- `cd ecomail/client`
- `npm install`
- `npm run dev`
- open `http://localhost:5173` in your browser
