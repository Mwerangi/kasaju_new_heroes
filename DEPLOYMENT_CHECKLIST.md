# QUICK DEPLOYMENT CHECKLIST
## For Existing Hosting - New Heroes International CMS

---

## 📦 PART 1: PREPARING YOUR PROJECT (On Your Computer)

### Step 1: Clean and Optimize
```bash
# Make the script executable
chmod +x prepare-for-upload.sh

# Run the preparation script
./prepare-for-upload.sh
```

**What this does:**
- ✅ Removes development files (node_modules, .git)
- ✅ Clears all caches
- ✅ Installs production dependencies
- ✅ Cleans storage folders

### Step 2: Create Upload Archive
```bash
# Create a compressed archive
tar -czf newheroescms.tar.gz \
  --exclude='node_modules' \
  --exclude='.git' \
  --exclude='.env' \
  --exclude='*.log' \
  .
```

**Or create ZIP file (if tar not available):**
```bash
zip -r newheroescms.zip . -x "node_modules/*" ".git/*" ".env" "*.log"
```

---

## 📤 PART 2: UPLOADING TO SERVER

### Option A: Upload via cPanel File Manager
1. Login to cPanel
2. Go to File Manager
3. Navigate to your domain's root directory
4. Upload `newheroescms.tar.gz`
5. Extract it using File Manager's Extract option

### Option B: Upload via FTP/SFTP
1. Open FileZilla or your FTP client
2. Connect to your hosting
3. Upload `newheroescms.tar.gz` to your domain folder
4. Use SSH or cPanel Terminal to extract

### Option C: Upload via SSH
```bash
# From your computer
scp newheroescms.tar.gz username@yourserver.com:/path/to/domain/
```

---

## 🔧 PART 3: POST-UPLOAD CONFIGURATION (On Server)

### Step 1: Extract Files (if not done via cPanel)
```bash
# SSH into your server
ssh username@yourserver.com

# Navigate to your domain folder
cd /path/to/your/domain

# Extract
tar -xzf newheroescms.tar.gz

# Remove archive
rm newheroescms.tar.gz
```

### Step 2: Configure Public Directory
Most hosting expects public files in `public_html` or `www` folder.

**Check your hosting structure:**
- If files are in `/home/username/newheroescms/`
- Public should be `/home/username/public_html/`

**Two options:**

**Option A: Point domain to /public folder (Recommended)**
In cPanel > Domains > Domain Management, change document root to:
```
/home/username/newheroescms/public
```

**Option B: Move public files (if can't change root)**
```bash
# Move contents of public to public_html
mv public/* ../public_html/
mv public/.htaccess ../public_html/

# Update index.php paths to point to correct location
```

### Step 3: Create and Configure .env File
```bash
# Copy production template
cp .env.production .env

# Edit with your hosting details
nano .env
# or use cPanel File Manager editor
```

**Critical settings to update:**
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_DATABASE=your_cpanel_database
DB_USERNAME=your_cpanel_db_user
DB_PASSWORD=your_cpanel_db_password
DB_HOST=localhost

MAIL_HOST=your_hosting_mail_server
MAIL_USERNAME=your-email@yourdomain.com
MAIL_PASSWORD=your_email_password
```

### Step 4: Run Deployment Script
```bash
# Make script executable
chmod +x deploy-on-server.sh

# Run it
./deploy-on-server.sh
```

**Or run commands manually:**
```bash
# Install dependencies
composer install --optimize-autoloader --no-dev

# Generate key
php artisan key:generate --force

# Run migrations
php artisan migrate --force

# Seed database
php artisan db:seed --force

# Create storage link
php artisan storage:link

# Cache everything
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Set permissions
chmod -R 755 .
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

---

## ✅ PART 4: POST-DEPLOYMENT TESTING

### 1. Test Website Access
- [ ] Visit: `https://yourdomain.com`
- [ ] Homepage loads correctly
- [ ] All images display
- [ ] Navigation works

### 2. Test Admin Panel
- [ ] Visit: `https://yourdomain.com/admin/login`
- [ ] Login with default credentials:
  - Email: `admin@newheroesintl.com`
  - Password: `admin123`
- [ ] **IMMEDIATELY change password**

### 3. Test Core Features
- [ ] Upload an image in Gallery
- [ ] Create a test blog post
- [ ] Submit inquiry form (check email arrives)
- [ ] Download company profile
- [ ] Check mobile responsiveness

### 4. Verify Security
- [ ] `.env` file is NOT accessible via browser
- [ ] `storage` folder is NOT browsable
- [ ] SSL certificate is active (https://)
- [ ] Admin area requires login

---

## 🔒 SECURITY CHECKLIST

### Immediately After Deployment:
- [ ] Change admin password
- [ ] Review all admin users
- [ ] Disable error display (`APP_DEBUG=false`)
- [ ] Check file permissions (755 for files, 775 for storage)
- [ ] Test .htaccess is working (protects sensitive files)

### Additional .htaccess Protection
If your `.env` is accessible, add to `public/.htaccess` (at the top):
```apache
<FilesMatch "^\.env">
    Order allow,deny
    Deny from all
</FilesMatch>
```

---

## 🐛 TROUBLESHOOTING COMMON ISSUES

### Issue 1: "500 Internal Server Error"
**Solution:**
```bash
# Check Laravel logs
tail -f storage/logs/laravel.log

# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Issue 2: "Database Connection Error"
**Solution:**
- Verify database exists in cPanel MySQL
- Check database credentials in .env
- Ensure database user has all permissions
- Try `DB_HOST=127.0.0.1` instead of `localhost`

### Issue 3: "Blank Page / White Screen"
**Solution:**
```bash
# Check permissions
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# Regenerate autoload
composer dump-autoload
```

### Issue 4: Images Not Loading
**Solution:**
```bash
# Recreate storage link
php artisan storage:link

# Check symbolic link exists
ls -la public/storage
```

### Issue 5: "Class not found" errors
**Solution:**
```bash
# Regenerate autoload
composer dump-autoload --optimize

# Clear compiled
php artisan clear-compiled
```

---

## 📞 HOSTING-SPECIFIC NOTES

### For cPanel Hosting:
- Database: Create via cPanel > MySQL Database
- PHP Version: Set to 8.1+ via cPanel > MultiPHP Manager
- Cronjobs: Set up via cPanel > Cron Jobs (if needed for scheduled tasks)
- Email: Use hosting's SMTP settings

### For Plesk Hosting:
- Similar to cPanel but different interface
- Ensure PHP-FPM is enabled
- Check document root points to `/public`

### Common Hosting Paths:
- **GoDaddy**: `/home/username/public_html/`
- **Bluehost**: `/home/username/public_html/`
- **HostGator**: `/home/username/public_html/`
- **Namecheap**: `/home/username/public_html/`

---

## 📊 PERFORMANCE OPTIMIZATION

### After Successful Deployment:
```bash
# Enable OPcache (check with hosting)
# Enable Redis/Memcached if available

# Optimize autoloader
composer dump-autoload --optimize --classmap-authoritative

# Cache everything
php artisan optimize
```

---

## 🔄 FUTURE UPDATES

### To Update the Site:
1. Make changes locally
2. Test thoroughly
3. Run `prepare-for-upload.sh`
4. Upload only changed files
5. Run on server:
```bash
composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan cache:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## 📞 NEED HELP?

**Check logs first:**
- Laravel: `storage/logs/laravel.log`
- Web server: Ask hosting support for error log location

**Common hosting support contacts:**
- cPanel: Use hosting's support ticket system
- Check hosting documentation/knowledge base
- Most issues are permission or .env configuration related

---

**Deployment Date:** `_____________`

**Server Details:** `_____________`

**Domain:** `_____________`

**Notes:** `_____________`
