#!/bin/bash
# Nuclear Option - Delete Everything and Rebuild
# Run this ON THE SERVER when nothing else works

echo "🚨 NUCLEAR FIX - Deleting all caches and rebuilding"
echo ""

cd /home/tynexcot/public_html/heroes.tynex.co.tz/New_heros || exit 1

# Step 1: Delete ALL cache and compiled files
echo "1. Deleting ALL cache files..."
rm -rf bootstrap/cache/*.php
rm -rf storage/framework/cache/*
rm -rf storage/framework/views/*
rm -rf storage/framework/sessions/*
rm -rf storage/framework/compiled.php
find storage/logs -type f -name "*.log" -exec truncate -s 0 {} \;
echo "   ✓ Caches deleted"

# Step 2: Delete vendor completely
echo "2. Deleting vendor directory..."
rm -rf vendor/
echo "   ✓ Vendor deleted"

# Step 3: Fresh composer install
echo "3. Fresh composer install (this takes time)..."
php ~/composer install --no-dev --optimize-autoloader --no-interaction
if [ $? -ne 0 ]; then
    echo "   ✗ Composer install FAILED!"
    exit 1
fi
echo "   ✓ Composer install complete"

# Step 4: Ensure directories exist
echo "4. Creating directories..."
mkdir -p storage/framework/{cache/data,views,sessions}
mkdir -p bootstrap/cache
mkdir -p storage/logs
chmod -R 775 storage bootstrap/cache
echo "   ✓ Directories ready"

# Step 5: Test
echo "5. Testing..."
if [ -f vendor/autoload.php ]; then
    echo "   ✓ Autoloader exists"
else
    echo "   ✗ Autoloader MISSING!"
    exit 1
fi

if [ -f .env ]; then
    echo "   ✓ .env exists"
else
    echo "   ✗ .env MISSING!"
    exit 1
fi

echo ""
echo "✅ DONE! Try your site now: https://heroes.tynex.co.tz"
echo ""
echo "If it still fails, check: tail -20 storage/logs/laravel.log"
