#!/bin/bash
# Complete Clean Install Script for New Heroes CMS
# Use this if fix-deployment.sh doesn't work
# Run this ON THE SERVER

echo "=========================================="
echo "🧹 New Heroes CMS - Complete Clean Install"
echo "=========================================="
echo ""
echo "⚠️  WARNING: This will delete vendor/ and reinstall everything"
echo ""
read -p "Continue? (y/n) " -n 1 -r
echo
if [[ ! $REPLY =~ ^[Yy]$ ]]
then
    echo "Cancelled."
    exit 1
fi

cd /home/tynexcot/public_html/heroes.tynex.co.tz/New_heros

echo ""
echo "Step 1: 🗑️  Deleting vendor directory..."
rm -rf vendor/
echo "✓ Vendor deleted"

echo ""
echo "Step 2: 🗑️  Deleting all cache files..."
rm -f bootstrap/cache/*.php
rm -rf storage/framework/cache/data/*
rm -rf storage/framework/views/*
rm -rf storage/framework/sessions/*
echo "✓ All caches deleted"

echo ""
echo "Step 3: 📦 Fresh composer install (this may take a few minutes)..."
php ~/composer install --no-dev --optimize-autoloader --no-interaction
if [ $? -eq 0 ]; then
    echo "✓ Composer install successful"
else
    echo "✗ Composer install failed!"
    echo "Try running manually: php ~/composer install --no-dev --optimize-autoloader"
    exit 1
fi

echo ""
echo "Step 4: 🔐 Setting permissions..."
chmod -R 775 storage
chmod -R 775 bootstrap/cache
echo "✓ Permissions set"

echo ""
echo "Step 5: 🎨 Ensuring directories exist..."
mkdir -p storage/framework/cache/data
mkdir -p storage/framework/views
mkdir -p storage/framework/sessions
mkdir -p bootstrap/cache
echo "✓ Directories created"

echo ""
echo "Step 6: 🔗 Creating storage symlink..."
php artisan storage:link
echo "✓ Storage linked"

echo ""
echo "=========================================="
echo "✅ Clean install complete!"
echo "=========================================="
echo ""
echo "Now try accessing your site: https://heroes.tynex.co.tz"
echo ""
echo "If you still have issues, check the error log:"
echo "  tail -50 /home/tynexcot/public_html/heroes.tynex.co.tz/New_heros/storage/logs/laravel.log"
