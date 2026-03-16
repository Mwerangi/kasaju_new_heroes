# CLEAN DEPLOYMENT GUIDE
## Fresh Start - No More Errors!

Follow these steps exactly:

---

## STEP 1: Prepare Locally (On Your Mac)

Open Terminal and run:

```bash
cd /Users/macbook/Documents/Projects/New_heros
./prepare-clean-deploy.sh
```

This will:
- Remove all files that shouldn't be uploaded (vendor, node_modules, caches)
- Create a clean archive: `newheroescms-clean.tar.gz`

---

## STEP 2: Upload to Server

Using cPanel File Manager or FTP:

1. **Upload** `newheroescms-clean.tar.gz` to:
   ```
   /home/tynexcot/public_html/heroes.tynex.co.tz/
   ```

2. **Extract** the archive:
   - Right-click → Extract
   - This creates the `New_heros/` directory

---

## STEP 3: Upload Server Setup Script

**Upload** `server-setup-clean.sh` to:
```
/home/tynexcot/public_html/heroes.tynex.co.tz/New_heros/
```

---

## STEP 4: Run Server Setup

Open SSH or cPanel Terminal and run:

```bash
cd /home/tynexcot/public_html/heroes.tynex.co.tz/New_heros
bash server-setup-clean.sh
```

**The script will:**
1. Create `.env` file → **PAUSE and ask you to edit database credentials**
2. Install composer dependencies (takes 2-3 minutes)
3. Generate app key
4. Create directories
5. Set permissions
6. Ask if you want to run migrations
7. Ask if you want to seed database
8. Create storage symlink
9. Optimize for production
10. Copy public files to web root
11. Create proper `index.php` and `.htaccess`

---

## STEP 5: Edit Database Credentials

When the script pauses, edit `.env`:

```bash
nano .env
```

Update these lines:
```env
DB_DATABASE=your_actual_database_name
DB_USERNAME=your_actual_database_user
DB_PASSWORD=your_actual_database_password
```

Press `Ctrl+X`, then `Y`, then `Enter` to save.

---

## STEP 6: Complete Setup

After editing `.env`, press Enter to continue the script.

When asked about migrations and seeding:
- Type `y` for migrations
- Type `y` for seeding (if you want demo data)

---

## STEP 7: Create Admin User

After setup completes, create your admin account:

```bash
php artisan tinker
```

Then paste this (replace with your details):

```php
$user = new App\Models\User();
$user->name = 'Admin';
$user->email = 'admin@newheroesintl.com';
$user->password = bcrypt('YourSecurePassword123');
$user->save();
exit
```

---

## STEP 8: Test Your Site

Visit: **https://heroes.tynex.co.tz**

Admin login: **https://heroes.tynex.co.tz/admin/login**

---

## If You Get Errors

Check logs:
```bash
cd /home/tynexcot/public_html/heroes.tynex.co.tz/New_heros
tail -20 storage/logs/laravel.log
```

---

## Key Differences That Fix All Previous Issues

✅ **No bootstrap/cache files uploaded** - Generated fresh on server  
✅ **No vendor directory uploaded** - Installed with proper `--no-dev` flag  
✅ **Proper index.php paths** - Points correctly to `New_heros/` subdirectory  
✅ **Fixed backup.php** - Handles missing ZipArchive gracefully  
✅ **Clean .env** - No local paths or configurations  
✅ **Proper structure** - Public files at root, Laravel code in subdirectory  

---

## Your Site Structure Will Be:

```
/home/tynexcot/public_html/heroes.tynex.co.tz/
├── index.php              ← Web entry (points to New_heros/)
├── .htaccess              ← Routing rules
├── assets/                ← Public assets
├── storage → symlink      ← Storage symlink
└── New_heros/             ← THE LARAVEL APP
    ├── app/
    ├── bootstrap/
    ├── config/
    ├── vendor/            ← Installed on server
    ├── .env               ← Production config
    └── ...
```

This is the **proper shared hosting structure** that avoids all our previous issues!
