#!/bin/bash
# STEP 2: Server Setup - Run this ON THE SERVER after uploading
# This sets up everything properly from scratch

echo "=========================================="
echo "🚀 New Heroes CMS - Clean Server Setup"
echo "=========================================="
echo ""

# Ensure we're in the right directory
cd /home/tynexcot/public_html/heroes.tynex.co.tz/New_heros || {
    echo "❌ Error: New_heros directory not found!"
    echo "Make sure you extracted the archive first."
    exit 1
}

echo "Step 1: Creating .env file..."
if [ ! -f .env ]; then
    cat > .env << 'EOF'
APP_NAME="New Heroes International"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://heroes.tynex.co.tz

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MAIL_MAILER=smtp
MAIL_HOST=mail.tynex.co.tz
MAIL_PORT=587
MAIL_USERNAME=info@newheroesintl.com
MAIL_PASSWORD=your_mail_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="info@newheroesintl.com"
MAIL_FROM_NAME="${APP_NAME}"
EOF
    echo "✓ .env created - EDIT IT WITH YOUR DATABASE CREDENTIALS!"
    echo ""
    read -p "Press Enter after you've edited .env with your database info..."
else
    echo "✓ .env already exists"
fi

echo ""
echo "Step 2: Installing composer dependencies (this takes 2-3 minutes)..."
php ~/composer install --no-dev --optimize-autoloader --no-interaction
if [ $? -ne 0 ]; then
    echo "❌ Composer install failed!"
    exit 1
fi
echo "✓ Dependencies installed"

echo ""
echo "Step 3: Generating application key..."
php artisan key:generate --force
echo "✓ Key generated"

echo ""
echo "Step 4: Creating necessary directories..."
mkdir -p storage/framework/cache/data
mkdir -p storage/framework/views
mkdir -p storage/framework/sessions
mkdir -p storage/logs
mkdir -p storage/app/public
mkdir -p bootstrap/cache
echo "✓ Directories created"

echo ""
echo "Step 5: Setting permissions..."
chmod -R 775 storage
chmod -R 775 bootstrap/cache
echo "✓ Permissions set"

echo ""
echo "Step 6: Running database migrations..."
read -p "Run migrations now? (y/n) " -n 1 -r
echo
if [[ $REPLY =~ ^[Yy]$ ]]; then
    php artisan migrate --force
    echo "✓ Migrations complete"
else
    echo "⚠ Skipped migrations - run manually: php artisan migrate --force"
fi

echo ""
echo "Step 7: Seeding database..."
read -p "Seed database with initial data? (y/n) " -n 1 -r
echo
if [[ $REPLY =~ ^[Yy]$ ]]; then
    php artisan db:seed --force
    echo "✓ Database seeded"
else
    echo "⚠ Skipped seeding"
fi

echo ""
echo "Step 8: Creating storage symlink..."
php artisan storage:link
echo "✓ Storage linked"

echo ""
echo "Step 9: Optimizing for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
echo "✓ Optimized"

echo ""
echo "Step 10: Moving public files to web root..."
echo "Copying assets to parent directory..."
cp -r public/* ../
echo "✓ Public files copied"

echo ""
echo "Step 11: Updating root index.php..."
cat > ../index.php << 'INDEXPHP'
<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

if (file_exists($maintenance = __DIR__.'/New_heros/storage/framework/maintenance.php')) {
    require $maintenance;
}

require __DIR__.'/New_heros/vendor/autoload.php';

$app = require_once __DIR__.'/New_heros/bootstrap/app.php';

$kernel = $app->make(Kernel::class);

$response = $kernel->handle(
    $request = Request::capture()
)->send();

$kernel->terminate($request, $response);
INDEXPHP
echo "✓ Root index.php updated"

echo ""
echo "Step 12: Creating .htaccess in web root..."
cat > ../.htaccess << 'HTACCESS'
<IfModule mod_rewrite.c>
    RewriteEngine On
    
    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]
    
    # Redirect Trailing Slashes...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]
    
    # Send Requests To Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
HTACCESS
echo "✓ .htaccess created"

echo ""
echo "=========================================="
echo "✅ Clean Setup Complete!"
echo "=========================================="
echo ""
echo "🌐 Your site should now be live at: https://heroes.tynex.co.tz"
echo ""
echo "📋 IMPORTANT - Create Admin User:"
echo "   php artisan tinker"
echo "   Then run:"
echo "   \$user = new App\Models\User();"
echo "   \$user->name = 'Admin';"
echo "   \$user->email = 'admin@newheroesintl.com';"
echo "   \$user->password = bcrypt('your-secure-password');"
echo "   \$user->save();"
echo ""
echo "📝 Notes:"
echo "   - Admin login: https://heroes.tynex.co.tz/admin/login"
echo "   - Error logs: tail -20 storage/logs/laravel.log"
echo ""
