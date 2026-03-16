#!/bin/bash

# Installation Script for New Heroes CMS
# Run this script after cloning the repository

echo "========================================="
echo "New Heroes International CMS Installation"
echo "========================================="
echo ""

# Check if running as root
if [ "$EUID" -eq 0 ]; then 
    echo "⚠️  Please do not run as root"
    exit 1
fi

# Check PHP version
echo "Checking PHP version..."
PHP_VERSION=$(php -v | head -n 1 | cut -d " " -f 2 | cut -f1-2 -d".")
if (( $(echo "$PHP_VERSION < 8.1" | bc -l) )); then
    echo "❌ PHP 8.1 or higher required. Current version: $PHP_VERSION"
    exit 1
fi
echo "✅ PHP version: $PHP_VERSION"

# Check if composer is installed
echo "Checking Composer..."
if ! command -v composer &> /dev/null; then
    echo "❌ Composer not found. Please install Composer first."
    exit 1
fi
echo "✅ Composer installed"

# Check if MySQL is running
echo "Checking MySQL..."
if ! command -v mysql &> /dev/null; then
    echo "⚠️  MySQL not found. Please ensure MySQL/MariaDB is installed."
fi

echo ""
echo "Starting installation..."
echo ""

# Step 1: Copy environment file
echo "Step 1: Setting up environment file..."
if [ ! -f .env ]; then
    cp .env.example .env
    echo "✅ .env file created"
else
    echo "⚠️  .env file already exists, skipping..."
fi

# Step 2: Install dependencies
echo ""
echo "Step 2: Installing PHP dependencies..."
composer install
echo "✅ Dependencies installed"

# Step 3: Generate application key
echo ""
echo "Step 3: Generating application key..."
php artisan key:generate
echo "✅ Application key generated"

# Step 4: Database configuration
echo ""
echo "========================================="
echo "Database Configuration"
echo "========================================="
read -p "Database Host (default: 127.0.0.1): " DB_HOST
DB_HOST=${DB_HOST:-127.0.0.1}

read -p "Database Port (default: 3306): " DB_PORT
DB_PORT=${DB_PORT:-3306}

read -p "Database Name (default: new_heroes_cms): " DB_NAME
DB_NAME=${DB_NAME:-new_heroes_cms}

read -p "Database Username (default: root): " DB_USER
DB_USER=${DB_USER:-root}

read -sp "Database Password: " DB_PASS
echo ""

# Update .env file
sed -i.bak "s/DB_HOST=.*/DB_HOST=$DB_HOST/" .env
sed -i.bak "s/DB_PORT=.*/DB_PORT=$DB_PORT/" .env
sed -i.bak "s/DB_DATABASE=.*/DB_DATABASE=$DB_NAME/" .env
sed -i.bak "s/DB_USERNAME=.*/DB_USERNAME=$DB_USER/" .env
sed -i.bak "s/DB_PASSWORD=.*/DB_PASSWORD=$DB_PASS/" .env

echo "✅ Database configuration updated"

# Step 5: Create database
echo ""
echo "Step 5: Creating database..."
mysql -h"$DB_HOST" -P"$DB_PORT" -u"$DB_USER" -p"$DB_PASS" -e "CREATE DATABASE IF NOT EXISTS $DB_NAME CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;" 2>/dev/null

if [ $? -eq 0 ]; then
    echo "✅ Database created successfully"
else
    echo "⚠️  Database may already exist or there was an error"
fi

# Step 6: Run migrations
echo ""
echo "Step 6: Running database migrations..."
php artisan migrate
echo "✅ Migrations completed"

# Step 7: Seed database
echo ""
echo "Step 7: Seeding initial data..."
read -p "Do you want to seed the database with sample data? (y/n): " SEED_DB
if [ "$SEED_DB" = "y" ] || [ "$SEED_DB" = "Y" ]; then
    php artisan db:seed
    echo "✅ Database seeded"
    echo ""
    echo "========================================="
    echo "Default Admin Credentials"
    echo "========================================="
    echo "Email: admin@newheroesintl.com"
    echo "Password: password"
    echo "⚠️  Please change this password after first login!"
    echo "========================================="
else
    echo "⏭️  Skipping database seeding"
fi

# Step 8: Create storage link
echo ""
echo "Step 8: Creating storage link..."
php artisan storage:link
echo "✅ Storage link created"

# Step 9: Set permissions
echo ""
echo "Step 9: Setting permissions..."
chmod -R 775 storage bootstrap/cache
echo "✅ Permissions set"

# Step 10: Clear and cache config
echo ""
echo "Step 10: Optimizing application..."
php artisan config:clear
php artisan cache:clear
php artisan config:cache
echo "✅ Application optimized"

# Installation complete
echo ""
echo "========================================="
echo "✅ Installation Complete!"
echo "========================================="
echo ""
echo "You can now start the development server:"
echo "php artisan serve"
echo ""
echo "Then visit: http://localhost:8000"
echo "Admin login: http://localhost:8000/login"
echo ""
echo "For production deployment, refer to DEPLOYMENT.md"
echo ""
echo "(ノ◕ヮ◕)ノ*:・゚✧ Happy coding! ✧゚・: *ヽ(◕ヮ◕ヽ)"
echo ""
