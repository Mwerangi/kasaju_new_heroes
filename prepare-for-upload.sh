#!/bin/bash
# Prepare New Heroes CMS for Production Upload
# Run this script BEFORE uploading to hosting

echo "=========================================="
echo "📦 Preparing New Heroes CMS for Upload"
echo "=========================================="
echo ""

# Step 1: Clean development files
echo "🧹 Cleaning development files..."
rm -rf node_modules/
rm -rf .git/
rm -f .env
rm -f .env.local
rm -f .env.testing
rm -f package-lock.json
rm -f yarn.lock

# Step 2: Clear all caches
echo "🗑️  Clearing caches..."
php artisan cache:clear 2>/dev/null || true
php artisan config:clear 2>/dev/null || true
php artisan route:clear 2>/dev/null || true
php artisan view:clear 2>/dev/null || true
rm -rf bootstrap/cache/*.php 2>/dev/null || true
rm -rf storage/logs/*.log 2>/dev/null || true

# Step 3: Install production dependencies
echo "📥 Installing production dependencies..."
composer install --optimize-autoloader --no-dev

# Step 4: Clean storage (keep structure)
echo "🗄️  Cleaning storage..."
rm -rf storage/app/public/*
rm -rf storage/framework/cache/*
rm -rf storage/framework/sessions/*
rm -rf storage/framework/views/*
rm -rf storage/logs/*

# Keep gitkeep files
touch storage/app/public/.gitkeep
touch storage/framework/cache/.gitkeep
touch storage/framework/sessions/.gitkeep
touch storage/framework/views/.gitkeep
touch storage/logs/.gitkeep

# Step 5: Create production .env copy
echo "⚙️  Preparing environment file..."
cp .env.production .env.production.template

echo ""
echo "✅ Project prepared for upload!"
echo ""
echo "=========================================="
echo "📤 NEXT STEPS:"
echo "=========================================="
echo "1. Create a TAR archive:"
echo "   tar -czf newheroescms.tar.gz --exclude='newheroescms.tar.gz' --exclude='*.tar.gz' --exclude='*.zip' ."
echo ""
echo "   Or create a ZIP file:"
echo "   zip -r newheroescms.zip . -x '*.tar.gz' '*.zip'"
echo ""
echo "2. Upload to your hosting server"
echo ""
echo "3. On server, run the post-upload script"
echo ""
echo "=========================================="
echo ""
echo "⚠️  IMPORTANT FILES TO EXCLUDE:"
echo "   - .git folder (already removed)"
echo "   - node_modules (already removed)"
echo "   - .env files (configure on server)"
echo ""
