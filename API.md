# API DOCUMENTATION
## New Heroes International CMS

This document provides information about potential API endpoints for future integration.

---

## FUTURE API CONSIDERATIONS

Currently, the system is designed as a traditional web application. However, the architecture supports easy addition of RESTful API endpoints.

### Potential API Endpoints

#### Services API
```
GET    /api/services              - List all active services
GET    /api/services/{slug}       - Get single service
```

#### Blog API
```
GET    /api/blog/posts            - List published posts
GET    /api/blog/posts/{slug}     - Get single post
GET    /api/blog/categories       - List categories
```

#### Gallery API
```
GET    /api/gallery               - List gallery images
GET    /api/gallery/categories    - List categories
```

#### Inquiries API
```
POST   /api/inquiries             - Submit inquiry/quote request
```

### Adding API Support

To add API support:

1. Install Laravel Sanctum:
```bash
composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate
```

2. Create API routes in `routes/api.php`

3. Create API resource controllers:
```bash
php artisan make:controller Api/ServiceController --api
```

4. Create API resources for data transformation:
```bash
php artisan make:resource ServiceResource
```

5. Add API authentication middleware

---

## WEBHOOKS

The system can be extended to support webhooks for:
- New inquiry notifications
- Content publication events
- User activity alerts

---

For questions about API integration, contact the development team.
