#!/bin/bash

# LITHOS - Hostinger Deployment Script
# Run this script after uploading files to Hostinger

echo "🚀 Starting LITHOS deployment on Hostinger..."

# Navigate to project directory
cd /home/u320563488/public_html/marble || exit

echo "📦 Installing Composer dependencies..."
composer install --optimize-autoloader --no-dev

echo "⚙️ Setting up environment file..."
if [ ! -f .env ]; then
    cp .env.example .env
    echo "✅ .env file created"
else
    echo "⚠️  .env file already exists, skipping..."
fi

echo "🔑 Generating application key..."
php artisan key:generate --force

echo "🔐 Setting permissions..."
chmod -R 755 storage bootstrap/cache
chmod -R 775 storage
chmod -R 775 bootstrap/cache

echo "🗄️ Running database migrations..."
php artisan migrate --force

echo "🌱 Seeding database..."
php artisan db:seed --force

echo "🔗 Creating storage link..."
php artisan storage:link

echo "⚡ Optimizing for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
composer dump-autoload --optimize

echo "✅ Deployment completed successfully!"
echo ""
echo "📋 Next steps:"
echo "1. Update .env file with your database credentials"
echo "2. Visit your website to verify"
echo "3. Login to /admin with default credentials"
echo "4. Change admin password immediately"
echo ""
echo "🎉 Your LITHOS application is ready!"
