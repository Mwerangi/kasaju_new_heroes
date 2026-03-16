# DEPLOYMENT GUIDE
## New Heroes International CMS

This guide provides step-by-step instructions for deploying the CMS to a production server.

---

## PRE-DEPLOYMENT CHECKLIST

- [ ] Server meets all requirements (PHP 8.1+, MySQL, etc.)
- [ ] Domain name configured and pointing to server
- [ ] SSL certificate ready (Let's Encrypt recommended)
- [ ] Database created
- [ ] Backup strategy in place
- [ ] All credentials changed from defaults

---

## SHARED HOSTING DEPLOYMENT

### Step 1: Upload Files

1. Compress the project:
```bash
tar -czf newheroescms.tar.gz --exclude='node_modules' --exclude='.git' .
```

2. Upload via FTP/SFTP to your hosting

3. Extract:
```bash
tar -xzf newheroescms.tar.gz
```

### Step 2: Configure Public Directory

- Move all files from `public` to your public_html or www directory
- Update `index.php` to point to correct paths

### Step 3: Set Environment

```bash
cp .env.example .env
nano .env
```

Update:
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### Step 4: Run Setup Commands

```bash
composer install --optimize-autoloader --no-dev
php artisan key:generate
php artisan migrate --force
php artisan db:seed --force
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Step 5: Set Permissions

```bash
chmod -R 755 storage bootstrap/cache
```

---

## VPS/DEDICATED SERVER DEPLOYMENT

### Step 1: Server Setup (Ubuntu 22.04)

```bash
# Update system
sudo apt update && sudo apt upgrade -y

# Install PHP 8.1
sudo apt install php8.1 php8.1-fpm php8.1-cli php8.1-mysql php8.1-mbstring php8.1-xml php8.1-bcmath php8.1-curl php8.1-gd php8.1-zip -y

# Install MySQL
sudo apt install mysql-server -y

# Install Nginx
sudo apt install nginx -y

# Install Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Install Node.js (optional)
curl -fsSL https://deb.nodesource.com/setup_18.x | sudo -E bash -
sudo apt install nodejs -y
```

### Step 2: Clone Repository

```bash
cd /var/www
git clone your-repository-url newheroesintl
cd newheroesintl
```

### Step 3: Install Dependencies

```bash
composer install --optimize-autoloader --no-dev
```

### Step 4: Configure Environment

```bash
cp .env.example .env
nano .env
```

### Step 5: Database Setup

```bash
# Login to MySQL
sudo mysql

# Create database and user
CREATE DATABASE new_heroes_cms CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'newheroesuser'@'localhost' IDENTIFIED BY 'strong_password_here';
GRANT ALL PRIVILEGES ON new_heroes_cms.* TO 'newheroesuser'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

### Step 6: Run Migrations

```bash
php artisan key:generate
php artisan migrate --force
php artisan db:seed --force
php artisan storage:link
```

### Step 7: Set Permissions

```bash
sudo chown -R www-data:www-data /var/www/newheroesintl
sudo chmod -R 755 /var/www/newheroesintl
sudo chmod -R 775 /var/www/newheroesintl/storage
sudo chmod -R 775 /var/www/newheroesintl/bootstrap/cache
```

### Step 8: Configure Nginx

```bash
sudo nano /etc/nginx/sites-available/newheroesintl
```

Add:
```nginx
server {
    listen 80;
    listen [::]:80;
    server_name yourdomain.com www.yourdomain.com;
    root /var/www/newheroesintl/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

Enable site:
```bash
sudo ln -s /etc/nginx/sites-available/newheroesintl /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl restart nginx
```

### Step 9: Install SSL Certificate

```bash
# Install Certbot
sudo apt install certbot python3-certbot-nginx -y

# Obtain certificate
sudo certbot --nginx -d yourdomain.com -d www.yourdomain.com

# Test auto-renewal
sudo certbot renew --dry-run
```

### Step 10: Optimize for Production

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
composer dump-autoload --optimize
```

---

## POST-DEPLOYMENT TASKS

### 1. Change Admin Passwords

Login with default credentials and immediately change passwords for all admin accounts.

### 2. Configure Backups

```bash
# Create backup script
nano /home/backup_cms.sh
```

Add:
```bash
#!/bin/bash
DATE=$(date +%Y%m%d_%H%M%S)

# Database backup
mysqldump -u username -p'password' new_heroes_cms > /backups/db_$DATE.sql

# Files backup
tar -czf /backups/files_$DATE.tar.gz /var/www/newheroesintl/storage/app/public

# Keep only last 7 days
find /backups -type f -mtime +7 -delete
```

Make executable:
```bash
chmod +x /home/backup_cms.sh
```

Add to crontab:
```bash
crontab -e
# Add: 0 2 * * * /home/backup_cms.sh
```

### 3. Setup Monitoring

Install monitoring tools:
```bash
# Install monitoring (optional)
sudo apt install htop iotop nethogs -y
```

### 4. Configure Firewall

```bash
# Enable UFW
sudo ufw allow 22/tcp
sudo ufw allow 80/tcp
sudo ufw allow 443/tcp
sudo ufw enable
```

### 5. Setup Log Rotation

Create log rotation config:
```bash
sudo nano /etc/logrotate.d/laravel
```

Add:
```
/var/www/newheroesintl/storage/logs/*.log {
    daily
    missingok
    rotate 14
    compress
    delaycompress
    notifempty
    create 0640 www-data www-data
    sharedscripts
}
```

---

## MAINTENANCE TASKS

### Regular Updates

```bash
# Pull latest changes
git pull origin main

# Update dependencies
composer install --no-dev --optimize-autoloader

# Run migrations
php artisan migrate --force

# Clear and rebuild cache
php artisan config:clear
php artisan cache:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Database Optimization

```bash
# Optimize tables
php artisan db:optimize

# Clean old logs (can be scheduled)
php artisan log:clear --days=30
```

---

## TROUBLESHOOTING

### Check Logs

```bash
tail -f /var/www/newheroesintl/storage/logs/laravel.log
tail -f /var/log/nginx/error.log
```

### Clear All Caches

```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan clear-compiled
composer dump-autoload
```

### Permission Issues

```bash
sudo chown -R www-data:www-data /var/www/newheroesintl
sudo chmod -R 755 /var/www/newheroesintl
sudo chmod -R 775 /var/www/newheroesintl/storage
sudo chmod -R 775 /var/www/newheroesintl/bootstrap/cache
```

### Database Connection Issues

Check:
1. MySQL is running: `sudo systemctl status mysql`
2. Database exists: `mysql -u username -p -e "SHOW DATABASES;"`
3. Credentials in .env are correct
4. User has proper permissions

---

## SECURITY CHECKLIST

- [ ] Changed all default passwords
- [ ] SSL certificate installed and working
- [ ] Firewall configured
- [ ] File permissions set correctly
- [ ] .env file not publicly accessible
- [ ] storage directory not publicly accessible
- [ ] APP_DEBUG set to false
- [ ] Regular backups configured
- [ ] Monitoring in place
- [ ] Log rotation configured

---

## SUPPORT

For deployment issues:
- Check Laravel logs: `storage/logs/laravel.log`
- Check Nginx logs: `/var/log/nginx/error.log`
- Review Laravel documentation
- Contact technical support

---

**Deployment Date:** _______________

**Deployed By:** _______________

**Server Details:** _______________
