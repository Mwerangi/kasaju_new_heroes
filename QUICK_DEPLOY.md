# 🚀 QUICK START DEPLOYMENT GUIDE

## For developers with existing hosting - 3 simple steps!

---

## 📦 STEP 1: Prepare (On Your Computer)

```bash
# Run the preparation script
./prepare-for-upload.sh

# Create archive for upload
tar -czf newheroescms.tar.gz .
```

**✅ This creates a production-ready package of your project**

---

## 📤 STEP 2: Upload (To Your Server)

Choose your method:

### Via cPanel:
1. Login → File Manager
2. Navigate to your domain folder
3. Upload `newheroescms.tar.gz`
4. Extract using File Manager

### Via FTP:
1. Open FileZilla
2. Upload to your domain folder
3. Extract via cPanel or SSH

---

## ⚙️ STEP 3: Configure & Deploy (On Server)

```bash
# SSH into your server
ssh your-user@your-server.com

# Go to project folder
cd /path/to/your/domain

# Create .env file
cp .env.production .env
nano .env  # Update with your database & email details

# Run deployment script
./deploy-on-server.sh
```

**✅ Your site is now live!**

---

## 🔐 Important: First Login

1. Visit: `https://yourdomain.com/admin/login`
2. Login with:
   - Email: `admin@newheroesintl.com`
   - Password: `admin123`
3. **IMMEDIATELY change the password!**

---

## 📋 What Each Script Does

### `prepare-for-upload.sh` (Run locally)
- Removes development files
- Clears caches  
- Installs production dependencies
- Optimizes for production

### `deploy-on-server.sh` (Run on server)
- Installs dependencies
- Generates application key
- Runs database migrations
- Seeds initial data
- Creates storage links
- Caches configurations
- Sets permissions

---

## 🆘 Need More Details?

See: [DEPLOYMENT_CHECKLIST.md](DEPLOYMENT_CHECKLIST.md)

---

## ⚠️ Quick Troubleshooting

**500 Error?**
```bash
chmod -R 775 storage bootstrap/cache
php artisan cache:clear
```

**Database Error?**
- Check `.env` database credentials
- Ensure database exists in cPanel

**Images Not Loading?**
```bash
php artisan storage:link
```

---

**That's it! Your CMS is ready for production! 🎉**
