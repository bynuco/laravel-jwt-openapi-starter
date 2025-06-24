# LARAVEL 12 RESTFUL API JWT AUTH SCRAMBLE-OPENAPI

This project is a Laravel 12-based RESTful API starter kit. It uses JWT-based authentication and Scramble for automatic API documentation.

**As a starter kit, it comes with a complete structure including request, resource, validation, controller, and model layers.** This allows developers to quickly start building a modern and secure RESTful API.

## Technologies and Tools Used

- **Laravel 12**: A popular framework for modern PHP web applications.
- **JWT Auth (`tymon/jwt-auth`)**: API authentication using JSON Web Tokens.
- **Scramble (`dedoc/scramble`)**: Automatic OpenAPI (Swagger) documentation.
- **Sanctum**: (Installed, but JWT Auth is used as the main authentication method.)
- **Pest**: A modern PHP testing framework.

## Installation

1. **Clone the project:**
   ```bash
   git clone <repo-url>
   cd laravel-jwt-openapi-starter
   ```

2. **Install dependencies:**
   ```bash
   composer install
   npm install && npm run build
   ```

3. **Create and configure the .env file:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Generate JWT Secret:**
   ```bash
   php artisan jwt:secret
   ```

5. **Set up your database and run migrations:**
   ```bash
   php artisan migrate
   ```

6. **Start the development server:**
   ```bash
   php artisan serve
   ```

## Authentication (JWT)

- **Register:** `POST /api/register`
- **Login:** `POST /api/login`
- **User Info:** `GET /api/user` (Protected by JWT)
- **Token Refresh:** `POST /api/refresh` (Protected by JWT)
- **Logout:** `POST /api/logout` (Protected by JWT)

All protected endpoints require the `Authorization: Bearer <token>` header.

### Example Login Response

```json
{
  "success": true,
  "data": {
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9..."
  }
}
```

## API Documentation with Scramble

- Automatically provides OpenAPI (Swagger) documentation at `/docs/api`.
- Bearer Auth support is automatically added for JWT-protected endpoints.

### Scramble Configuration

`app/Providers/ScrambleProvider.php`:
```php
public function boot(): void
{
    Scramble::configure()
        ->withDocumentTransformers(function (OpenApi $openApi) {
            $openApi->secure(
                SecurityScheme::http('bearer', 'JWT')
            );
        });
}
```
---

**Note:**  
- For API endpoints and sample requests, please refer to the documentation at `/docs/api`.
