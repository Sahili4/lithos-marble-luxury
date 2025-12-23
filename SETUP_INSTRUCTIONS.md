# LITHOS - Laravel Setup Instructions

## Step 1: Run Migrations and Seed Database

```bash
cd /Users/sahilarman/Downloads/marble_luxury/marble_luxury_laravel

# Run migrations to create tables
php artisan migrate

# Seed database with admin user and sample catalogs
php artisan db:seed
```

**Default Admin Credentials:**
- Email: `admin@lithos.com`
- Password: `password`

## Step 2: Create Storage Link (for image uploads)

```bash
php artisan storage:link
```

## Step 3: Configure WhatsApp Number

Open `resources/views/home.blade.php` and find line ~183:

```php
<a href="https://wa.me/919876543210?text=...
```

**Replace `919876543210` with your WhatsApp business number** (with country code, no + or spaces)

Example formats:
- India: `919876543210`
- USA: `14155552671`
- UAE: `971501234567`

## Step 4: Start Development Server

```bash
php artisan serve
```

The application will be available at: `http://localhost:8000`

## Step 5: Access Admin Panel

1. Visit: `http://localhost:8000/admin`
2. Login with admin credentials above
3. Start managing catalogs and contact messages!

## Features Implemented

### Admin Panel (`/admin`)
- ✅ Dashboard with statistics
- ✅ Catalog Management (Create, Edit, Delete)
- ✅ Image Upload for catalogs
- ✅ Contact Messages Management
- ✅ Mark messages as read/unread
- ✅ DataTables for sorting and searching

### Frontend (`/`)
- ✅ Dynamic catalog display from database
- ✅ WhatsApp icon on each catalog item
- ✅ Contact form with database storage
- ✅ All original luxury design preserved
- ✅ Responsive and animated

## Database Tables

### catalogs
- id, name, slug, origin, description, image, type, application
- is_featured, sort_order, status, timestamps

### contact_messages
- id, name, phone, email, message, is_read, ip_address, timestamps

### users
- id, name, email, password, timestamps (for admin login)

## Quick Commands Reference

```bash
# Run migrations
php artisan migrate

# Seed database
php artisan db:seed

# Create storage link
php artisan storage:link

# Start server
php artisan serve

# Clear cache (if needed)
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

## Troubleshooting

**If migrations fail:**
```bash
php artisan migrate:fresh --seed
```

**If images don't show:**
```bash
php artisan storage:link
```

**If you get 404 errors:**
Make sure you're in the correct directory and server is running.

## Next Steps

1. Add more catalog items via admin panel
2. Customize WhatsApp message format in `home.blade.php`
3. Update contact information in footer
4. Add your own images to replace placeholders
5. Configure email notifications for contact form (optional)

---

**Enjoy your new dynamic marble luxury website! 🎉**
