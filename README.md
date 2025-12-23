# LITHOS - Marble Luxury Laravel Application

A dynamic Laravel 10 web application for a luxury marble and stone collection business with a comprehensive admin panel, WhatsApp integration, and modern UI.

## 🌟 Features

### Frontend
- ✨ Luxury design with smooth animations
- 📱 Fully responsive layout
- 🟢 WhatsApp integration on each product
- 📄 Dynamic catalog with pagination
- 🔍 Product detail pages
- 📧 Contact form with database storage
- 🎨 Custom cursor effects and 3D tilt cards

### Admin Panel
- 📊 Dashboard with statistics
- 💎 Complete catalog management (CRUD)
- 🖼️ Image upload system
- ✉️ Contact message management
- ⚙️ Settings management (WhatsApp config)
- 🔐 Secure authentication with Laravel Breeze
- 📋 DataTables for easy data management

## 🚀 Quick Start

### Prerequisites
- PHP >= 8.1
- Composer
- MySQL or SQLite
- Node.js & NPM

### Installation

1. **Clone the repository**
```bash
git clone <your-repo-url>
cd marble_luxury_laravel
```

2. **Install dependencies**
```bash
composer install
npm install
```

3. **Environment setup**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Configure database**
Edit `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=marble_luxury
DB_USERNAME=root
DB_PASSWORD=your_password
```

Or use SQLite (simpler):
```env
DB_CONNECTION=sqlite
```

5. **Run migrations and seed**
```bash
# For SQLite, create database file first
touch database/database.sqlite

# Run migrations
php artisan migrate

# Seed with sample data
php artisan db:seed

# Create storage link for images
php artisan storage:link
```

6. **Build assets**
```bash
npm run build
```

7. **Start development server**
```bash
php artisan serve
```

Visit: `http://localhost:8000`

## 🔑 Default Credentials

**Admin Panel** (`/admin`)
- Email: `admin@lithos.com`
- Password: `password`

**⚠️ Change these credentials after first login!**

## ⚙️ Configuration

### WhatsApp Setup
1. Login to admin panel
2. Go to **Settings**
3. Update **WhatsApp Number** (with country code, e.g., 919876543210)
4. Customize **WhatsApp Message** template
   - Use `{product_name}` for product name
   - Use `{product_url}` for product page URL

### Adding Catalogs
1. Go to **Catalogs** → **Add New**
2. Fill in product details
3. Upload product image
4. Set as featured (optional)
5. Save

## 📁 Project Structure

```
marble_luxury_laravel/
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/          # Admin panel controllers
│   │   ├── HomeController.php
│   │   ├── ContactController.php
│   │   └── CatalogDetailController.php
│   └── Models/
│       ├── Catalog.php
│       ├── ContactMessage.php
│       └── Setting.php
├── database/
│   ├── migrations/         # Database schema
│   └── seeders/           # Sample data
├── resources/
│   └── views/
│       ├── admin/         # Admin panel views
│       ├── home.blade.php # Frontend homepage
│       └── catalog-detail.blade.php
├── public/
│   ├── assets/           # Images
│   └── css/              # Styles
└── routes/
    └── web.php           # Application routes
```

## 🛠️ Tech Stack

- **Backend**: Laravel 10
- **Authentication**: Laravel Breeze
- **Frontend**: Blade Templates, Vanilla JavaScript
- **Styling**: Custom CSS + Bootstrap 5 (admin)
- **Database**: MySQL / SQLite
- **Icons**: Font Awesome 6
- **Tables**: DataTables
- **Alerts**: SweetAlert2

## 📝 Key Routes

### Public Routes
- `/` - Homepage
- `/catalog/{slug}` - Product detail page
- `/contact` - Contact form submission

### Admin Routes (Auth Required)
- `/admin` - Dashboard
- `/admin/catalogs` - Catalog management
- `/admin/messages` - Contact messages
- `/admin/settings` - Site settings

## 🎨 Features in Detail

### Load More Functionality
- Initial load shows 8 catalogs
- AJAX-powered pagination
- Smooth loading with animations

### WhatsApp Integration
- Configurable from admin panel
- Appears on hover over product images
- Pre-filled message with product details
- Opens in new tab

### Admin Settings
- WhatsApp number configuration
- Message template customization
- Catalogs per page setting

## 🔧 Common Commands

```bash
# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Fresh migration with seed
php artisan migrate:fresh --seed

# Create storage link
php artisan storage:link

# Run development server
php artisan serve

# Build assets for production
npm run build
```

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 👨‍💻 Developer

Created with ❤️ for luxury marble businesses

---

**Note**: Remember to update the WhatsApp number and other contact details in the admin settings and footer before deploying to production.
