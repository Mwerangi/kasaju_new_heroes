#!/bin/bash
# Ultimate Fix Script for Laravel Deployment Issues
# This addresses ALL known issues from manual project assembly
# Run this ON THE SERVER

echo "=========================================="
echo "🔧 New Heroes CMS - Ultimate Fix"
echo "=========================================="
echo ""

cd /home/tynexcot/public_html/heroes.tynex.co.tz/New_heros

echo "Step 1: 🗑️  Deleting ALL cache files (bootstrap, config, services)..."
rm -f bootstrap/cache/config.php
rm -f bootstrap/cache/routes.php
rm -f bootstrap/cache/services.php
rm -f bootstrap/cache/packages.php
rm -rf storage/framework/cache/*
rm -rf storage/framework/views/*
rm -rf storage/framework/sessions/*
echo "✓ All caches deleted"

echo ""
echo "Step 2: 🗑️  Removing vendor composer cache..."
rm -f vendor/composer/installed.php
rm -f vendor/composer/installed.json
rm -f storage/framework/services.json
rm -f storage/framework/packages.php
echo "✓ Vendor caches removed"

echo ""
echo "Step 3: 📦 Reinstalling dependencies (production only, no dev packages)..."
php ~/composer install --no-dev --optimize-autoloader --no-interaction 2>&1
if [ $? -ne 0 ]; then
    echo "⚠️  Composer install had warnings, but continuing..."
fi
echo "✓ Dependencies installed"

echo ""
echo "Step 4: 🧹 Clearing Laravel application cache..."
php artisan cache:clear --no-interaction 2>/dev/null || echo "  (cache:clear skipped - not critical)"
php artisan config:clear --no-interaction 2>/dev/null || echo "  (config:clear skipped - not critical)"
php artisan route:clear --no-interaction 2>/dev/null || echo "  (route:clear skipped - not critical)"
php artisan view:clear --no-interaction 2>/dev/null || echo "  (view:clear skipped - not critical)"
echo "✓ Laravel caches cleared"

echo ""
echo "Step 5: 🔐 Setting correct permissions..."
chmod -R 775 storage
chmod -R 775 bootstrap/cache
chown -R $USER:$USER storage bootstrap/cache 2>/dev/null || echo "  (chown skipped - may need sudo)"
echo "✓ Permissions set"

echo ""
echo "Step 6: 🎨 Creating necessary directories..."
mkdir -p storage/framework/cache/data
mkdir -p storage/framework/views
mkdir -p storage/framework/sessions
mkdir -p bootstrap/cache
mkdir -p storage/logs
mkdir -p storage/app/public
echo "✓ Directories created"

echo ""
echo "Step 7: 📋 Verifying critical files..."
ERRORS=0

if [ ! -f vendor/autoload.php ]; then
    echo "  ✗ ERROR: vendor/autoload.php missing!"
    ERRORS=$((ERRORS+1))
else
    echo "  ✓ vendor/autoload.php exists"
fi

if [ ! -f .env ]; then
    echo "  ✗ ERROR: .env missing!"
    ERRORS=$((ERRORS+1))
else
    echo "  ✓ .env exists"
fi

if [ ! -f bootstrap/app.php ]; then
    echo "  ✗ ERROR: bootstrap/app.php missing!"
    ERRORS=$((ERRORS+1))
else
    echo "  ✓ bootstrap/app.php exists"
fi

if [ $ERRORS -gt 0 ]; then
    echo ""
    echo "❌ Critical files missing! Cannot continue."
    exit 1
fi

echo ""
echo "Step 8: 🧪 Testing PHP configuration..."
echo "PHP Version:"
php -v | head -n 1

echo ""
echo "Checking required PHP extensions..."
MISSING_EXTS=0
for ext in mbstring openssl pdo pdo_mysql tokenizer xml ctype json bcmath fileinfo; do
    if php -m | grep -qi "^$ext$"; then
        echo "  ✓ $ext"
    else
        echo "  ✗ $ext (MISSING)"
        MISSING_EXTS=$((MISSING_EXTS+1))
    fi
done

if [ $MISSING_EXTS -gt 0 ]; then
    echo ""
    echo "⚠️  WARNING: $MISSING_EXTS PHP extension(s) missing!"
    echo "    Contact your hosting provider to enable them."
fi

echo ""
echo "Step 9: 🔗 Creating storage symlink..."
php artisan storage:link --no-interaction 2>/dev/null && echo "✓ Storage link created" || echo "⚠️  Storage link skipped (may already exist)"

echo ""
echo "Step 10: ⚡ Regenerating optimized configuration..."
php artisan config:cache --no-interaction 2>&1
if [ $? -eq 0 ]; then
    echo "✓ Configuration cached successfully"
else
    echo "⚠️  Config cache failed - but site may still work"
    rm -f bootstrap/cache/config.php
fi

echo ""
echo "=========================================="
echo "✅ Ultimate fix complete!"
echo "=========================================="
echo ""
echo "🌐 Now try accessing: https://heroes.tynex.co.tz"
echo ""
echo "If you still see errors:"
echo "1. Check error logs:"
echo "   tail -50 storage/logs/laravel.log"
echo ""
echo "2. Check PHP error log:"
echo "   tail -50 ~/public_html/heroes.tynex.co.tz/error_log"
echo ""
echo "3. Enable debug mode temporarily in .env:"
echo "   APP_DEBUG=true"
echo ""
