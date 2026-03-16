#!/bin/bash
# Post-Upload Setup Script for New Heroes CMS
# Run this script ON THE SERVER after uploading files

echo "=========================================="
echo "🚀 New Heroes CMS - Post-Upload Setup"
echo "=========================================="
echo ""

# Check if .env exists
if [ ! -f .env ]; then
    echo "⚠️  ERROR: .env file not found!"
    echo "Please create .env from .env.production and configure it first."
    exit 1
fi

echo "📋 Step 1: Installing/Updating dependencies..."
composer install --optimize-autoloader --no-dev

echo ""
echo "🔑 Step 2: Generating application key..."
php artisan key:generate --force

echo ""
echo "🗄️  Step 3: Running database migrations..."
read -p "Do you want to run migrations? (y/n) " -n 1 -r
echo
if [[ $REPLY =~ ^[Yy]$ ]]
then
    php artisan migrate --force
fi

echo ""
echo "🌱 Step 4: Seeding database..."
read -p "Do you want to seed the database with initial data? (y/n) " -n 1 -r
echo
if [[ $REPLY =~ ^[Yy]$ ]]
then
    php artisan db:seed --force
fi

echo ""
echo "🔗 Step 5: Creating storage symlink..."
php artisan storage:link

echo ""
echo "⚡ Step 6: Optimizing for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
composer dump-autoload --optimize

echo ""
echo "🔒 Step 7: Setting file permissions..."
chmod -R 755 .
chmod -R 775 storage
chmod -R 775 bootstrap/cache

echo ""
echo "✅ Deployment Complete!"
echo ""
echo "=========================================="
echo "📝 POST-DEPLOYMENT CHECKLIST:"
echo "=========================================="
echo "[ ] 1. Test website: APP_URL from .env"
echo "[ ] 2. Login to admin: /admin/login"
echo "[ ] 3. Change default admin password"
echo "[ ] 4. Test inquiry form submission"
echo "[ ] 5. Test file uploads in admin"
echo "[ ] 6. Check email notifications work"
echo "[ ] 7. Verify SSL certificate is active"
echo "[ ] 8. Test all public pages"
echo ""
echo "=========================================="
echo "🔐 DEFAULT ADMIN CREDENTIALS:"
echo "=========================================="
echo "Email: admin@newheroesintl.com"
echo "Password: admin123"
echo ""
echo "⚠️  CHANGE THESE IMMEDIATELY AFTER LOGIN!"
echo ""
