# LARAVEL 12 RESTFUL API JWT AUTH SCRAMBLE-OPENAPI 

Bu proje, Laravel 12 tabanlı bir RESTful API starter kitidir. JWT tabanlı kimlik doğrulama ve otomatik API dokümantasyonu için Scramble kullanır. 

**Starter kit olarak; request, resource, validation, controller, model gibi katmanların tamamı eksiksiz şekilde yapılandırılmıştır.** Böylece geliştiriciler, modern ve güvenli bir RESTful API geliştirmeye hızlıca başlayabilirler.

## Kullanılan Teknolojiler ve Araçlar

- **Laravel 12**: Modern PHP web uygulamaları için popüler framework.
- **JWT Auth (`tymon/jwt-auth`)**: JSON Web Token ile API kimlik doğrulama.
- **Scramble (`dedoc/scramble`)**: Otomatik OpenAPI (Swagger) dokümantasyonu.
- **Sanctum**: (Kurulu, ancak JWT Auth ana kimlik doğrulama olarak kullanılıyor.)
- **Pest**: Testler için modern PHP test framework'ü.

## Kurulum

1. **Projeyi klonlayın:**
   ```bash
   git clone <repo-url>
   cd laravel-jwt-openapi-starter
   ```

2. **Bağımlılıkları yükleyin:**
   ```bash
   composer install
   npm install && npm run build
   ```

3. **.env dosyasını oluşturun ve yapılandırın:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **JWT Secret oluşturun:**
   ```bash
   php artisan jwt:secret
   ```

5. **Veritabanı ayarlarını yapın ve migrate edin:**
   ```bash
   php artisan migrate
   ```

6. **Geliştirme sunucusunu başlatın:**
   ```bash
   php artisan serve
   ```

## Kimlik Doğrulama (JWT)

- **Kayıt:** `POST /api/register`
- **Giriş:** `POST /api/login`
- **Kullanıcı Bilgisi:** `GET /api/user` (JWT ile korumalı)
- **Token Yenileme:** `POST /api/refresh` (JWT ile korumalı)
- **Çıkış:** `POST /api/logout` (JWT ile korumalı)

Tüm korumalı endpoint'lere erişmek için `Authorization: Bearer <token>` header'ı gereklidir.

### Örnek Giriş Yanıtı

```json
{
  "success": true,
  "data": {
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9..."
  }
}
```

## Scramble ile API Dokümantasyonu

- Otomatik olarak `/docs/api` adresinde OpenAPI (Swagger) dokümantasyonu sunar.
- JWT ile korumalı endpoint'ler için Bearer Auth desteği otomatik olarak eklenmiştir.

### Scramble Konfigürasyonu

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

## Testler

```bash
php artisan test
# veya
vendor/bin/pest
```

## Katkı ve Lisans

MIT Lisansı ile lisanslanmıştır. Katkılarınızı bekleriz!

---

**Not:**  
- API endpoint'leri ve örnek istekler için `/docs/api` adresindeki dokümantasyonu inceleyebilirsiniz.
