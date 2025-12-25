# 🚀 Hostinger Deployment Guide - LITHOS

## Current Status
- ✅ Files uploaded to: `public_html/marble`
- ❌ 403 Error (Permission/Configuration issue)
- 📊 Database: `u320563488_marble`

---

## 🔧 SSH Setup Commands

### Step 1: Connect to Hostinger via SSH

```bash
# SSH login (Hostinger will provide these details)
ssh u320563488@your-domain.com -p 65002
# Or use the SSH details from Hostinger panel
```

### Step 2: Navigate to Project Directory

```bash
cd public_html/marble
```

### Step 3: Install Composer Dependencies

```bash
# Install dependencies
composer install --optimize-autoloader --no-dev
```

### Step 4: Configure Environment File

```bash
# Copy .env.example to .env
cp .env.example .env

# Edit .env file
nano .env
```

**Paste these values in .env:**

```env
APP_NAME=LITHOS
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://your-domain.com

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=u320563488_marble
DB_USERNAME=u320563488_marble
DB_PASSWORD=Marble@Pbc123

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

**Save and exit:** Press `Ctrl+X`, then `Y`, then `Enter`

### Step 5: Generate Application Key

```bash
php artisan key:generate
```

### Step 6: Set Proper Permissions

```bash
# Set directory permissions
chmod -R 755 storage bootstrap/cache

# Set file ownership (if needed)
chown -R $USER:$USER storage bootstrap/cache

# Make storage writable
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### Step 7: Run Database Migrations

```bash
# Run migrations
php artisan migrate --force

# Seed database with initial data
php artisan db:seed --force
```

### Step 8: Create Storage Link

```bash
php artisan storage:link
```

### Step 9: Optimize for Production

```bash
# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache

# Optimize autoloader
composer dump-autoload --optimize
```

### Step 10: Fix Public Directory Access

Hostinger expects files in `public_html`. You have two options:

#### **Option A: Move public contents to root (Recommended)**

```bash
# Navigate to marble directory
cd /home/u320563488/public_html/marble

# Move all files from public to parent directory
mv public/* ../
mv public/.htaccess ../

# Update index.php paths
cd ..
nano index.php
```

**Update these lines in index.php:**

```php
// Change from:
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';

// To:
require __DIR__.'/marble/vendor/autoload.php';
$app = require_once __DIR__.'/marble/bootstrap/app.php';
```

#### **Option B: Create .htaccess redirect**

```bash
cd /home/u320563488/public_html

# Create/edit .htaccess
nano .htaccess
```

**Add this content:**

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ marble/public/$1 [L]
</IfModule>
```

---

## 🔍 Verify Installation

### Check if everything is working:

```bash
# Check Laravel version
php artisan --version

# Check database connection
php artisan migrate:status

# List routes
php artisan route:list
```

---

## 🛠️ Troubleshooting

### If 403 Error Persists:

1. **Check .htaccess in public folder:**
```bash
cd public_html/marble/public
cat .htaccess
```

Should contain:
```apache
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Send Requests To Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
```

2. **Check file permissions:**
```bash
ls -la public_html/marble
```

3. **Check PHP version:**
```bash
php -v
# Should be PHP 8.1 or higher
```

4. **Clear all caches:**
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### If Database Connection Fails:

```bash
# Test database connection
php artisan tinker
>>> DB::connection()->getPdo();
```

### If Storage Images Don't Show:

```bash
# Recreate storage link
rm public/storage
php artisan storage:link

# Check permissions
chmod -R 755 storage/app/public
```

---

## 📋 Post-Deployment Checklist

- [ ] `.env` file configured with production values
- [ ] `APP_DEBUG=false` in production
- [ ] Database migrations run successfully
- [ ] Storage link created
- [ ] Permissions set correctly (755 for directories, 644 for files)
- [ ] Caches optimized
- [ ] Admin login working (`/admin`)
- [ ] WhatsApp settings configured in admin panel
- [ ] Test contact form submission
- [ ] Test catalog display
- [ ] Test image uploads

---

## 🔐 Security Checklist

- [ ] Change default admin password
- [ ] Set strong `APP_KEY`
- [ ] `APP_DEBUG=false` in production
- [ ] Remove `.env.example` from public access
- [ ] Set proper file permissions
- [ ] Enable HTTPS (SSL certificate)
- [ ] Configure CORS if needed

---

## 🎯 Quick Commands Reference

```bash
# Connect via SSH
ssh u320563488@your-domain.com -p 65002

# Navigate to project
cd public_html/marble

# Clear all caches
php artisan optimize:clear

# Run migrations
php artisan migrate --force

# Seed database
php artisan db:seed --force

# Check logs
tail -f storage/logs/laravel.log
```

---

## 📞 Need Help?

If you encounter any issues:

1. Check Laravel logs: `storage/logs/laravel.log`
2. Check server error logs (Hostinger panel)
3. Verify PHP version and extensions
4. Contact Hostinger support for server-specific issues

---

**Your site should now be live! 🎉**

Visit: `https://your-domain.com`
Admin: `https://your-domain.com/admin`
