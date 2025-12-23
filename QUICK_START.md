# 🚀 LITHOS - Quick Start Guide

## ⚡ Get Started in 3 Steps

### 1️⃣ Setup Database
```bash
cd /Users/sahilarman/Downloads/marble_luxury/marble_luxury_laravel
php artisan migrate
php artisan db:seed
php artisan storage:link
```

### 2️⃣ Configure WhatsApp
Edit `resources/views/home.blade.php` line 183:
```php
// Change this number to yours (with country code, no + or spaces)
https://wa.me/919876543210?text=...
       ↑ Replace this
```

### 3️⃣ Start Server
```bash
php artisan serve
```
Visit: **http://localhost:8000**

---

## 🔑 Admin Access

**URL**: http://localhost:8000/admin

**Login:**
- Email: `admin@lithos.com`
- Password: `password`

---

## 📋 What You Can Do

### Admin Panel
- ✅ Add/Edit/Delete marble catalogs
- ✅ Upload product images
- ✅ View contact form submissions
- ✅ Mark messages as read/unread
- ✅ Manage featured products

### Frontend
- ✅ Dynamic catalog display
- ✅ WhatsApp button on each product
- ✅ Contact form with database storage
- ✅ All original luxury design preserved

---

## 🎯 Common Tasks

**Add New Product:**
1. Login to admin
2. Catalogs → Add New
3. Fill details + upload image
4. Save

**Check Messages:**
1. Login to admin
2. Messages → View all
3. Click to read details

**Change WhatsApp Number:**
- Edit `resources/views/home.blade.php` line 183

---

## 📁 Important Files

- **Frontend**: `resources/views/home.blade.php`
- **Admin Layout**: `resources/views/admin/layouts/app.blade.php`
- **Routes**: `routes/web.php`
- **Catalog Model**: `app/Models/Catalog.php`
- **Styles**: `public/css/style.css`

---

## 🆘 Troubleshooting

**Migrations fail?**
```bash
php artisan migrate:fresh --seed
```

**Images not showing?**
```bash
php artisan storage:link
```

**Cache issues?**
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

---

## ✨ Features

- 🎨 Luxury design preserved
- 📱 Fully responsive
- 🟢 WhatsApp integration
- 🔐 Secure admin panel
- 📊 DataTables for easy management
- 🖼️ Image upload system
- ✉️ Contact form management
- ⭐ Featured products system

---

**Need detailed docs?** Check `SETUP_INSTRUCTIONS.md`

**Ready to use!** 🎉
