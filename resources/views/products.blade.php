<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $category ? $category . ' - ' : '' }}Products | LITHOS</title>
    <meta name="description" content="Browse our exquisite collection of luxury marble and stone">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;1,400&family=Montserrat:wght@300;400;500&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Floating WhatsApp Button */
        .floating-whatsapp {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 32px;
            text-decoration: none;
            box-shadow: 0 4px 20px rgba(37, 211, 102, 0.5);
            z-index: 9998;
            transition: all 0.3s ease;
            animation: pulse 2s infinite;
        }

        .floating-whatsapp:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 30px rgba(37, 211, 102, 0.7);
        }

        @keyframes pulse {

            0%,
            100% {
                box-shadow: 0 4px 20px rgba(37, 211, 102, 0.5);
            }

            50% {
                box-shadow: 0 4px 30px rgba(37, 211, 102, 0.8);
            }
        }

        /* Dropdown Menu Styling */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: rgba(26, 26, 26, 0.98);
            min-width: 220px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            z-index: 1000;
            border-radius: 8px;
            margin-top: 5px;
            padding: 10px 0;
        }

        .dropdown-content a {
            color: rgba(255, 255, 255, 0.8);
            padding: 12px 20px;
            text-decoration: none;
            display: block;
            transition: all 0.3s;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .dropdown-content a:last-child {
            border-bottom: none;
        }

        .dropdown-content a:hover {
            background-color: rgba(201, 169, 97, 0.2);
            color: #c9a961;
            padding-left: 25px;
        }

        /* Keep dropdown open when hovering */
        .dropdown:hover .dropdown-content,
        .dropdown-content:hover {
            display: block;
        }

        .dropbtn i {
            font-size: 0.8em;
            margin-left: 5px;
        }

        .products-page {
            min-height: 100vh;
            background: #1a1a1a;
            padding: 120px 0 80px;
        }

        .page-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .page-header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 4rem;
            margin-bottom: 20px;
            color: #c9a961;
        }

        .page-header p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 1.1rem;
        }

        .category-filter {
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 60px;
        }

        .filter-btn {
            padding: 10px 25px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            border-radius: 50px;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s;
        }

        .filter-btn:hover,
        .filter-btn.active {
            background: #c9a961;
            border-color: #c9a961;
            color: #000;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 40px;
            margin-bottom: 60px;
        }

        .product-card {
            background: rgba(255, 255, 255, 0.03);
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.3s;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        .product-image {
            position: relative;
            width: 100%;
            aspect-ratio: 4/5;
            overflow: hidden;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }

        .product-card:hover .product-image img {
            transform: scale(1.1);
        }

        .whatsapp-icon {
            position: absolute;
            top: 15px;
            right: 15px;
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 22px;
            text-decoration: none;
            box-shadow: 0 4px 15px rgba(37, 211, 102, 0.4);
            transition: all 0.3s ease;
            z-index: 10;
            opacity: 0;
        }

        .product-card:hover .whatsapp-icon {
            opacity: 1;
        }

        .whatsapp-icon:hover {
            transform: scale(1.1);
        }

        .product-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.4s;
        }

        .product-card:hover .product-overlay {
            opacity: 1;
        }

        .product-overlay a {
            border: 1px solid rgba(255, 255, 255, 0.8);
            padding: 12px 24px;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 3px;
            backdrop-filter: blur(4px);
            color: white;
            text-decoration: none;
        }

        .product-info {
            padding: 20px;
        }

        .product-info h3 {
            font-size: 1.3rem;
            margin-bottom: 5px;
            color: white;
        }

        .product-info p {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 40px;
        }

        .pagination a,
        .pagination span {
            padding: 10px 15px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            border-radius: 5px;
            transition: all 0.3s;
        }

        .pagination a:hover,
        .pagination .active {
            background: #c9a961;
            border-color: #c9a961;
            color: #000;
        }

        .no-products {
            text-align: center;
            padding: 80px 20px;
            color: rgba(255, 255, 255, 0.5);
        }

        .no-products i {
            font-size: 4rem;
            margin-bottom: 20px;
            opacity: 0.3;
        }
    </style>
</head>

<body>
    <header>
        <nav>
            <div class="logo">
                <img src="{{ asset(\App\Models\Setting::get('site_logo', 'assets/IMG_6346.PNG')) }}"
                    alt="{{ \App\Models\Setting::get('company_name', 'LITHOS') }}" style="max-height: 50px;">
            </div>
            <ul class="nav-links">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li class="dropdown">
                    <a href="{{ route('products.index') }}" class="dropbtn">
                        Products <i class="fas fa-chevron-down"></i>
                    </a>
                    <div class="dropdown-content">
                        @foreach($categories as $cat)
                            <a href="{{ route('products.index', ['category' => $cat]) }}">{{ $cat }}</a>
                        @endforeach
                    </div>
                </li>
                <li><a href="{{ route('home') }}#philosophy">History</a></li>
                <li><a href="{{ route('home') }}#legacy">Culture</a></li>
                <li><a href="{{ route('home') }}#portfolio">Testimonials</a></li>
                <li><a href="{{ route('home') }}#services">Blog</a></li>
                <li><a href="{{ route('home') }}#contact">Contact Us</a></li>
                <li><a href="{{ route('home') }}#process">About Us</a></li>
            </ul>
            <div class="menu-btn-mobile">
                <span class="menu-text">MENU</span>
                <i class="fas fa-times menu-icon"></i>
            </div>
        </nav>
    </header>

    <!-- Mobile Menu Overlay -->
    <div class="mobile-menu-overlay" id="mobileMenu">
        <div class="mobile-menu-content">
            <ul class="mobile-nav-links">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li class="mobile-dropdown">
                    <a href="#" class="mobile-dropdown-toggle">
                        Products <i class="fas fa-chevron-down"></i>
                    </a>
                    <div class="mobile-dropdown-content">
                        @foreach($categories as $cat)
                            <a href="{{ route('products.index', ['category' => $cat]) }}">{{ $cat }}</a>
                        @endforeach
                    </div>
                </li>
                <li><a href="{{ route('home') }}#philosophy">History</a></li>
                <li><a href="{{ route('home') }}#legacy">Culture</a></li>
                <li><a href="{{ route('home') }}#portfolio">Testimonials</a></li>
                <li><a href="{{ route('home') }}#services">Blog</a></li>
                <li><a href="{{ route('home') }}#contact">Contact Us</a></li>
                <li><a href="{{ route('home') }}#process">About Us</a></li>
            </ul>
        </div>
    </div>

    <main class="products-page">
        <div class="container">
            <div class="page-header">
                <h1>{{ $category ?? 'All Products' }}</h1>
                <p>Exquisite stone collections sourced from the world's most exclusive quarries</p>
            </div>

            <!-- Category Filter -->
            <div class="category-filter">
                <a href="{{ route('products.index') }}" class="filter-btn {{ !$category ? 'active' : '' }}">
                    All Products
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('products.index', ['category' => $cat]) }}"
                        class="filter-btn {{ $category == $cat ? 'active' : '' }}">
                        {{ $cat }}
                    </a>
                @endforeach
            </div>

            <!-- Products Grid -->
            @if($catalogs->count() > 0)
                <div class="products-grid">
                    @foreach($catalogs as $catalog)
                        <div class="product-card">
                            <div class="product-image">
                                <img src="{{ asset($catalog->image) }}" alt="{{ $catalog->name }}">

                                <!-- WhatsApp Icon -->
                                @php
                                    $whatsappNumber = \App\Models\Setting::get('whatsapp_number', '919876543210');
                                    $whatsappMessage = \App\Models\Setting::get('whatsapp_message', "Hi, I'm interested in {product_name}. {product_url}");
                                    $productUrl = route('catalog.detail', $catalog->slug);
                                    $message = str_replace(
                                        ['{product_name}', '{product_url}'],
                                        [$catalog->name, $productUrl],
                                        $whatsappMessage
                                    );
                                @endphp
                                <a href="https://wa.me/{{ $whatsappNumber }}?text={{ urlencode($message) }}"
                                    class="whatsapp-icon" target="_blank" title="Contact us on WhatsApp">
                                    <i class="fab fa-whatsapp"></i>
                                </a>

                                <div class="product-overlay">
                                    <a href="{{ route('catalog.detail', $catalog->slug) }}">View Details</a>
                                </div>
                            </div>
                            <div class="product-info">
                                <h3>{{ $catalog->name }}</h3>
                                <p>{{ $catalog->origin }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="pagination">
                    {{ $catalogs->links() }}
                </div>
            @else
                <div class="no-products">
                    <i class="fas fa-box-open"></i>
                    <h3>No products found</h3>
                    <p>Try selecting a different category</p>
                </div>
            @endif
        </div>
    </main>

    <!-- Floating WhatsApp Button -->
    @php
        $floatingWhatsappNumber = \App\Models\Setting::get('whatsapp_number', '919876543210');
        $floatingWhatsappMessage = \App\Models\Setting::get('whatsapp_message', "Hi, I'm interested in your marble collection.");
    @endphp
    <a href="https://wa.me/{{ $floatingWhatsappNumber }}?text={{ urlencode($floatingWhatsappMessage) }}"
        class="floating-whatsapp" target="_blank" title="Chat on WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>

    <footer>
        <div class="footer-grid">
            <div class="footer-col brand-col">
                <div class="logo">
                    <img src="{{ asset(\App\Models\Setting::get('site_logo', 'assets/IMG_6346.PNG')) }}"
                        alt="{{ \App\Models\Setting::get('company_name', 'LITHOS') }}" style="max-height: 60px;">
                </div>
                <p>Exquisite stone collections sourced from the world's most exclusive quarries.</p>
            </div>
            <div class="footer-col">
                <h4>Menu</h4>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('products.index') }}">Products</a></li>
                    <li><a href="{{ route('home') }}#contact">Contact</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Contact</h4>
                <p>{{ \App\Models\Setting::get('company_address', '123 Luxury Ave, Design District, Milan, Italy 20121') }}
                </p>
                <p class="contact-link">{{ \App\Models\Setting::get('company_mobile', '+39 02 1234 5678') }}</p>
                <p class="contact-link">{{ \App\Models\Setting::get('company_email', 'concierge@lithos.com') }}</p>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="copyright">&copy; {{ date('Y') }} {{ \App\Models\Setting::get('company_name', 'LITHOS') }}. All
                rights reserved.</div>
        </div>
    </footer>

    <script>
        // Mobile Menu Functionality
        const menuBtn = document.querySelector('.menu-btn-mobile');
        const mobileMenu = document.getElementById('mobileMenu');
        const mobileDropdownToggle = document.querySelector('.mobile-dropdown-toggle');

        if (menuBtn) {
            menuBtn.addEventListener('click', () => {
                const isActive = mobileMenu.classList.contains('active');

                if (isActive) {
                    // Close menu
                    mobileMenu.classList.remove('active');
                    menuBtn.classList.remove('active');
                    document.body.style.overflow = 'auto';
                } else {
                    // Open menu
                    mobileMenu.classList.add('active');
                    menuBtn.classList.add('active');
                    document.body.style.overflow = 'hidden';
                }
            });
        }

        // Close menu when clicking outside
        if (mobileMenu) {
            mobileMenu.addEventListener('click', (e) => {
                if (e.target === mobileMenu) {
                    mobileMenu.classList.remove('active');
                    menuBtn.classList.remove('active');
                    document.body.style.overflow = 'auto';
                }
            });
        }

        // Mobile dropdown toggle
        if (mobileDropdownToggle) {
            mobileDropdownToggle.addEventListener('click', (e) => {
                e.preventDefault();
                const dropdownContent = mobileDropdownToggle.nextElementSibling;
                dropdownContent.classList.toggle('active');
                mobileDropdownToggle.classList.toggle('active');
            });
        }

        // Close mobile menu when clicking on a link (except dropdown toggle)
        document.querySelectorAll('.mobile-nav-links a').forEach(link => {
            if (!link.classList.contains('mobile-dropdown-toggle')) {
                link.addEventListener('click', () => {
                    mobileMenu.classList.remove('active');
                    menuBtn.classList.remove('active');
                    document.body.style.overflow = 'auto';
                });
            }
        });
    </script>
</body>

</html>