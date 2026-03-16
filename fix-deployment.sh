#!/bin/bash
# Emergency Fix Script for New Heroes CMS Deployment Issues
# Run this ON THE SERVER to fix bootstrap/cache issues

echo "=========================================="
echo "🔧 New Heroes CMS - Emergency Fix"
echo "=========================================="
echo ""

cd /home/tynexcot/public_html/heroes.tynex.co.tz/New_heros

echo "Step 1: 🗑️  Deleting corrupted cache files..."
rm -f bootstrap/cache/config.php
rm -f bootstrap/cache/routes.php
rm -f bootstrap/cache/services.php
rm -f bootstrap/cache/packages.php
echo "✓ Cache files deleted"

echo ""
echo "Step 2: 🧹 Clearing storage caches..."
rm -rf storage/framework/cache/data/*
rm -rf storage/framework/views/*
rm -rf storage/framework/sessions/*
echo "✓ Storage caches cleared"

echo ""
echo "Step 3: 📦 Cleaning vendor cache..."
rm -rf vendor/composer/installed.json
rm -rf vendor/composer/autoload_*.php
echo "✓ Vendor cache cleaned"

echo ""
echo "Step 4: 📦 Reinstalling composer dependencies (production only)..."
php ~/composer install --no-dev --optimize-autoloader --no-interaction
echo "✓ Dependencies installed"

echo ""
echo "Step 5: 🔐 Setting permissions..."
chmod -R 775 storage
chmod -R 775 bootstrap/cache
echo "✓ Permissions set"

echo ""
echo "Step 6: 🎨 Creating necessary directories..."
mkdir -p storage/framework/cache/data
mkdir -p storage/framework/views
mkdir -p storage/framework/sessions
mkdir -p bootstrap/cache
echo "✓ Directories created"

echo ""
echo "Step 7: 📋 Verifying critical files..."
echo "Checking vendor/autoload.php..."
if [ -f vendor/autoload.php ]; then
    echo "  ✓ vendor/autoload.php exists"
else
    echo "  ✗ ERROR: vendor/autoload.php missing!"
    echo "  Run: php ~/composer install --no-dev --optimize-autoloader"
    exit 1
fi

echo "Checking .env..."
if [ -f .env ]; then
    echo "  ✓ .env exists"
else
    echo "  ✗ ERROR: .env missing!"
    exit 1
fi


echo "Checking bootstrap/app.php..."
if [ -f bootstrap/app.php ]; then
    echo "  ✓ bootstrap/app.php exists"
else
    echo "  ✗ ERROR: bootstrap/app.php missing!"
    exit 1
fi

echo ""
echo "Step 8: 🧪 Testing PHP configuration..."
echo "PHP Version:"
php -v | head -n 1

echo ""
echo "Required Extensions:"
php -m | grep -E 'mbstring|openssl|pdo|tokenizer|xml|ctype|json|bcmath|fileinfo' | sort

echo ""
echo "=========================================="
echo "✅ Fix complete!"
echo "=========================================="
echo ""
echo "Now try accessing your site."
echo "If you still get errors, run:"
echo "  tail -50 /home/tynexcot/public_html/heroes.tynex.co.tz/New_heros/storage/logs/laravel.log"
