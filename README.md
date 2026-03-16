# NEW HEROES INTERNATIONAL LIMITED
## Dynamic CMS Corporate Website

A production-ready corporate website with a comprehensive CMS admin panel for New Heroes International Limited, a clearing and forwarding company in Tanzania.

---

## 📋 TABLE OF CONTENTS

- [Project Overview](#project-overview)
- [Features](#features)
- [Technology Stack](#technology-stack)
- [System Requirements](#system-requirements)
- [Installation Guide](#installation-guide)
- [Default Admin Credentials](#default-admin-credentials)
- [Database Structure](#database-structure)
- [Project Structure](#project-structure)
- [Usage Guide](#usage-guide)
- [Security Features](#security-features)
- [Performance Optimization](#performance-optimization)
- [Deployment Instructions](#deployment-instructions)
- [Troubleshooting](#troubleshooting)
- [Support](#support)

---

## 🎯 PROJECT OVERVIEW

This is a modern, scalable corporate website with a powerful CMS that allows non-technical staff to manage all website content without coding knowledge. The system consists of two main modules:

1. **Public Website** - Professional frontend for visitors
2. **Admin CMS Dashboard** - Comprehensive content management system

### Company Information

**Company Name:** NEW HEROES INTERNATIONAL LIMITED

**Industry:** Clearing and Forwarding / Logistics

**Location:**
- Leader House Floor 1 Room 120
- Opposite GBP Petro Station
- Dar es Salaam, Tanzania

**Contact:**
- +255 625 544 404
- +255 742 058 897
- +255 776 717 081

---

## ✨ FEATURES

### Public Website Features

- **Homepage** with hero banner, featured services, testimonials
- **About Page** with company information, mission, vision
- **Services Page** with dynamic service listings
- **Clearance Process Page** with step-by-step workflow
- **Gallery** with category filtering
- **Testimonials** from satisfied clients
- **Blog/News** with categories and search
- **Request Quote Form** with file upload
- **Contact Page** with inquiry form
- **Downloadable Company Profile**
- **Fully Responsive Design** (Mobile, Tablet, Desktop)
- **SEO Optimized** with meta tags and structured data

### Admin CMS Features

- **Dashboard** with statistics and recent activity
- **Page Management** - Edit pages and sections dynamically
- **Services Management** - Add, edit, delete, reorder services
- **Process Steps Management** - Manage clearance workflow steps
- **Gallery Management** - Upload images with categories
- **Testimonials Management** - Manage client testimonials
- **Blog Management** - Create, publish, categorize posts
- **Inquiries Management** - View and manage quote requests
- **Contact Information** - Update contact details
- **Downloads Management** - Manage downloadable files
- **Media Library** - Centralized media management
- **SEO Settings** - Per-page SEO configuration
- **Site Settings** - Global site configuration
- **User Management** - Create and manage admin users
- **Role-Based Access Control** - Super Admin, Content Manager, Editor roles
- **Activity Logs** - Track all admin actions

---

## 🛠 TECHNOLOGY STACK

### Backend
- **Laravel 10.x** - PHP framework
- **PHP 8.1+** - Programming language
- **MySQL/MariaDB** - Database

### Frontend
- **Laravel Blade** - Templating engine
- **Tailwind CSS** - CSS framework
- **JavaScript** - Client-side scripting
- **Font Awesome 6** - Icons

### Key Packages
- **Spatie Laravel Permission** - Role-based access control
- **Intervention Image** - Image processing
- **TinyMCE/CKEditor** - Rich text editing

---

## 💻 SYSTEM REQUIREMENTS

- PHP >= 8.1
- Composer >= 2.0
- MySQL >= 5.7 or MariaDB >= 10.3
- Node.js >= 16.x (for asset compilation)
- Apache or Nginx web server
- Git (for version control)

### Recommended Server Specifications

**Development:**
- 2GB RAM minimum
- 2 CPU cores
- 10GB disk space

**Production:**
- 4GB RAM minimum
- 4 CPU cores
- 50GB disk space
- SSL certificate

---

## 📦 INSTALLATION GUIDE

### Step 1: Clone the Repository

```bash
cd /Users/macbook/Documents/Projects/New_heros
```

### Step 2: Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node dependencies (if using Vite/Mix)
npm install
```

### Step 3: Environment Configuration

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### Step 4: Configure Database

Edit the `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=new_heroes_cms
DB_USERNAME=root
DB_PASSWORD=your_password
```

### Step 5: Create Database

```bash
# Login to MySQL
mysql -u root -p

# Create database
CREATE DATABASE new_heroes_cms CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

### Step 6: Run Migrations and Seeders

```bash
# Run migrations
php artisan migrate

# Run seeders (creates sample data and admin user)
php artisan db:seed
```

### Step 7: Storage Setup

```bash
# Create storage link
php artisan storage:link

# Set permissions (Linux/Mac)
chmod -R 775 storage bootstrap/cache
```

### Step 8: Start Development Server

```bash
# Start Laravel development server
php artisan serve
```

Visit: `http://localhost:8000`

---

## 🔐 DEFAULT ADMIN CREDENTIALS

After running the seeders, use these credentials to login:

### Super Admin
- **Email:** admin@newheroesintl.com
- **Password:** password
- **Role:** Full system access

### Content Manager
- **Email:** manager@newheroesintl.com
- **Password:** password
- **Role:** Content management access

### Editor
- **Email:** editor@newheroesintl.com
- **Password:** password
- **Role:** Limited editing access

**⚠️ IMPORTANT:** Change these passwords immediately after first login!

### Admin Dashboard URL

`http://localhost:8000/login`

---

## 🗄 DATABASE STRUCTURE

### Core Tables

1. **users** - Admin users
2. **roles & permissions** - Access control
3. **pages** - Website pages
4. **page_sections** - Page content sections
5. **services** - Company services
6. **process_steps** - Clearance workflow steps
7. **galleries** - Image gallery
8. **gallery_categories** - Gallery categories
9. **testimonials** - Client testimonials
10. **blog_posts** - Blog articles
11. **blog_categories** - Blog categories
12. **inquiries** - Quote requests
13. **contact_information** - Contact details
14. **downloads** - Downloadable files
15. **media** - Media library
16. **seo_settings** - SEO configuration
17. **site_settings** - Site configuration
18. **activity_logs** - Admin activity tracking

### Relationships

- Users have Roles (many-to-many)
- Pages have Sections (one-to-many)
- Blog Posts belong to Categories (many-to-one)
- Blog Posts have Authors (many-to-one)
- Galleries belong to Categories (many-to-one)
- Inquiries can be assigned to Users (many-to-one)

---

## 📁 PROJECT STRUCTURE

```
New_heros/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/          # Admin CMS controllers
│   │   │   └── Web/            # Public website controllers
│   │   └── Middleware/
│   └── Models/                 # Eloquent models
├── database/
│   ├── migrations/             # Database migrations
│   └── seeders/                # Database seeders
├── public/
│   ├── storage/                # Public storage link
│   └── index.php
├── resources/
│   └── views/
│       ├── admin/              # Admin dashboard views
│       └── web/                # Public website views
├── routes/
│   ├── web.php                 # Web routes
│   └── console.php             # Console routes
├── storage/
│   ├── app/
│   │   └── public/             # File uploads
│   └── logs/                   # Application logs
├── .env.example
├── composer.json
├── artisan
└── README.md                   # This file
```

---

## 📖 USAGE GUIDE

### For Administrators

#### Managing Services

1. Login to admin dashboard
2. Navigate to **Services** > **All Services**
3. Click **Add Service** to create new service
4. Fill in service details:
   - Title, description
   - Upload icon/image
   - Set as featured (optional)
   - Set display order
5. Click **Save**

#### Managing Blog Posts

1. Navigate to **Blog** > **All Posts**
2. Click **Add Post**
3. Write content using rich text editor
4. Upload featured image
5. Assign category
6. Set SEO meta tags
7. Publish or save as draft

#### Managing Inquiries

1. Navigate to **Inquiries**
2. View all quote requests
3. Click on inquiry to view details
4. Update status (New, Read, Replied, Closed)
5. Assign to team member
6. Add admin notes
7. Mark as replied when done

#### Managing Gallery

1. Navigate to **Gallery** > **All Images**
2. Click **Upload Image**
3. Select image file
4. Add title and caption
5. Assign to category
6. Set display order
7. Publish

#### Managing Users

1. Navigate to **Users** (Super Admin only)
2. Click **Add User**
3. Enter user details
4. Assign role (Super Admin, Content Manager, Editor)
5. Activate/deactivate users

### For Content Editors

Content Managers and Editors have restricted access based on their roles. They can manage content within their permissions but cannot access system settings or user management.

---

## 🔒 SECURITY FEATURES

### Implemented Security Measures

1. **Authentication & Authorization**
   - Laravel's built-in authentication
   - Role-based access control
   - Session security

2. **Input Validation**
   - Form request validation
   - CSRF protection
   - XSS prevention

3. **File Upload Security**
   - Allowed file types validation
   - File size restrictions
   - Secure file storage

4. **Password Security**
   - Bcrypt hashing
   - Password confirmation
   - Secure password reset

5. **Rate Limiting**
   - Login attempt throttling
   - Form submission limits

6. **Activity Logging**
   - All admin actions logged
   - IP address tracking
   - User agent logging

### Security Best Practices

```bash
# Never commit .env file
# Keep dependencies updated
composer update

# Clear cache after updates
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

---

## ⚡ PERFORMANCE OPTIMIZATION

### Implemented Optimizations

1. **Database Indexing**
   - Foreign keys indexed
   - Search columns indexed
   - Order columns indexed

2. **Eager Loading**
   - Relationships loaded efficiently
   - N+1 query prevention

3. **Image Optimization**
   - Recommended: Use intervention/image
   - Generate thumbnails
   - Lazy loading on frontend

4. **Caching Strategy**
   - Cache configuration
   - Route caching
   - View caching

### Enable Caching (Production)

```bash
# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache

# Optimize autoloader
composer install --optimize-autoloader --no-dev
```

---

## 🚀 DEPLOYMENT INSTRUCTIONS

### Preparation

1. **Update Environment**
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com
```

2. **Optimize Application**
```bash
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

3. **Set Permissions**
```bash
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### Apache Configuration

Create `.htaccess` in public directory:

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ index.php/$1 [L]
</IfModule>
```

### Nginx Configuration

```nginx
server {
    listen 80;
    server_name yourdomain.com;
    root /path/to/New_heros/public;
    
    index index.php;
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
    
    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

### SSL Certificate (Let's Encrypt)

```bash
# Install Certbot
sudo apt install certbot python3-certbot-nginx

# Obtain certificate
sudo certbot --nginx -d yourdomain.com -d www.yourdomain.com

# Auto-renewal
sudo certbot renew --dry-run
```

### Backup Strategy

```bash
# Database backup
mysqldump -u username -p new_heroes_cms > backup_$(date +%Y%m%d).sql

# File backup
tar -czf uploads_backup_$(date +%Y%m%d).tar.gz storage/app/public/
```

---

## 🔧 TROUBLESHOOTING

### Common Issues

#### Issue: 500 Internal Server Error

**Solution:**
```bash
# Check permissions
chmod -R 775 storage bootstrap/cache

# Clear cache
php artisan cache:clear
php artisan config:clear

# Check error logs
tail -f storage/logs/laravel.log
```

#### Issue: Database Connection Error

**Solution:**
- Verify database credentials in `.env`
- Ensure MySQL is running
- Check database exists
- Test connection: `php artisan tinker` then `DB::connection()->getPdo();`

#### Issue: Images Not Displaying

**Solution:**
```bash
# Recreate storage link
php artisan storage:link

# Check storage permissions
chmod -R 775 storage/app/public
```

#### Issue: Route Not Found

**Solution:**
```bash
# Clear route cache
php artisan route:clear
php artisan route:cache
```

### Debug Mode

Enable debug mode temporarily:

```env
APP_DEBUG=true
```

**⚠️ Never enable debug mode in production!**

---

## 📞 SUPPORT

### Contact Information

**New Heroes International Limited**
- Email: info@newheroesintl.com
- Phone: +255 625 544 404
- WhatsApp: +255 742 058 897
- Address: Leader House Floor 1 Room 120, Dar es Salaam, Tanzania

### Developer Support

For technical support or customization:
- Review the code documentation
- Check Laravel documentation: https://laravel.com/docs
- Check Spatie Permission docs: https://spatie.be/docs/laravel-permission

---

## 📝 LICENSE

This project is proprietary software developed for New Heroes International Limited.
All rights reserved.

---

## 🎉 CONCLUSION

This CMS system is production-ready and follows Laravel best practices. It's designed to be:

- **Scalable** - Easy to add new features
- **Maintainable** - Clean, well-structured code
- **Secure** - Industry-standard security measures
- **User-Friendly** - Intuitive admin interface
- **SEO-Optimized** - Built-in SEO features

For any questions or support needs, contact the development team or refer to this documentation.

**Built with ❤️ for New Heroes International Limited**
