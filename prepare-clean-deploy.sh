#!/bin/bash
# STEP 1: Prepare project for upload
# Run this LOCALLY before uploading

echo "=========================================="
echo "📦 Preparing New Heroes CMS for Deployment"
echo "=========================================="
echo ""

# Delete all files that should NOT be uploaded
echo "Step 1: Cleaning files that shouldn't be uploaded..."
rm -rf node_modules/
rm -rf vendor/
rm -rf bootstrap/cache/*.php
rm -rf storage/framework/cache/*
rm -rf storage/framework/views/*
rm -rf storage/framework/sessions/*
find storage/logs -type f -name "*.log" -exec rm {} \;
echo "✓ Cleaned"

# Create archive
echo ""
echo "Step 2: Creating clean archive..."
tar -czf newheroescms-clean-2.tar.gz \
    --exclude='node_modules' \
    --exclude='vendor' \
    --exclude='bootstrap/cache/*.php' \
    --exclude='storage/framework/cache/*' \
    --exclude='storage/framework/views/*' \
    --exclude='storage/framework/sessions/*' \
    --exclude='storage/logs/*.log' \
    --exclude='.git' \
    --exclude='.env' \
    --exclude='*.tar.gz' \
    .

echo "✓ Archive created: newheroescms-clean-2.tar.gz"
echo ""
echo "=========================================="   
echo "✅ Ready for upload!"
echo "=========================================="
echo ""
echo "NEXT STEPS:"
echo "1. Upload newheroescms-clean.tar.gz to your server"
echo "2. Extract it in: /home/tynexcot/public_html/heroes.tynex.co.tz/"
echo "3. Run the server setup script"
