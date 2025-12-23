<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LITHOS | Exquisite Stone Collection</title>
    <meta name="description" content="Curated collection of the world's most exclusive marble and quartzite.">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;1,400&family=Montserrat:wght@300;400;500&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* WhatsApp Icon Styling */
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

        .card:hover .whatsapp-icon {
            opacity: 1;
        }

        .whatsapp-icon:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 20px rgba(37, 211, 102, 0.6);
        }

        .card-image {
            position: relative;
        }

        /* Success message styling */
        .alert-success {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            background: #25D366;
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                transform: translateX(400px);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
    </style>
</head>

<body>
    <!-- Success Message -->
    @if(session('success'))
        <div class="alert-success" id="success-alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        </div>
        <script>
            setTimeout(() => {
                document.getElementById('success-alert').style.display = 'none';
            }, 5000);
        </script>
    @endif

    <!-- Cool Add-on 1: Luxury Preloader -->
    <div class="preloader">
        <div class="loader-logo">LITHOS</div>
    </div>

    <div class="cursor-dot"></div>
    <div class="cursor-outline"></div>

    <header>
        <nav>
            <div class="logo">LITHOS</div>
            <ul class="nav-links">
                <li><a href="#philosophy">Philosophy</a></li>
                <li><a href="#legacy">Heritage</a></li>
                <li><a href="#collection">Collection</a></li>
                <li><a href="#portfolio">Projects</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
            <div class="menu-btn-mobile">Menu</div>
        </nav>
    </header>

    <main>
        <!-- Hero Section -->
        <section class="hero" id="home">
            <div class="hero-bg"></div>
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <span class="subtitle slide-up">The Art of Earth</span>
                <h1 class="slide-up delay-1">Timeless<br>Elegance</h1>
                <a href="#collection" class="cta-btn slide-up delay-2">View Collection</a>
            </div>
            <div class="scroll-indicator">
                <span>Explore</span>
                <div class="line"></div>
            </div>
        </section>

        <!-- Intro / Philosophy (LIGHT MODE) -->
        <section class="intro light-section" id="philosophy">
            <div class="container">
                <div class="intro-text reveal-text">
                    <span class="section-label">Philosophy</span>
                    <h2>Beyond Stone. <br>A Legacy.</h2>
                    <p>We source the rarest slabs from the most exclusive quarries in Italy, Brazil, and Greece. For
                        those who demand nothing less than perfection.</p>
                </div>
            </div>
        </section>

        <!-- Legacy Section (Dark) -->
        <section class="legacy" id="legacy">
            <div class="legacy-grid">
                <div class="legacy-content reveal-text">
                    <span class="section-label">Heritage</span>
                    <h3>The Quarry's<br>Secret</h3>
                    <p>Deep within the Apuan Alps, where Michelangelo once walked, lies the source of our purest
                        Statuario. We have exclusive access to veins that have remained untouched for centuries.</p>
                    <a href="#process" class="text-link">Discover the Source</a>
                </div>
                <div class="legacy-image reveal-image">
                    <img src="{{ asset('assets/images/legacy.png') }}" alt="Historic Quarry" data-tilt>
                </div>
            </div>
        </section>

        <!-- The Collection (LIGHT MODE) - DYNAMIC -->
        <section class="collection light-section" id="collection">
            <div class="container">
                <div class="section-header">
                    <h3>The Curated Collection</h3>
                    <div class="separator" style="background: rgba(0,0,0,0.1);"></div>
                </div>

                <div class="grid" id="catalog-grid">
                    @forelse($catalogs as $index => $catalog)
                        <div class="card reveal-card tilt-card delay-{{ $index % 4 }}">
                            <div class="card-image">
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

                                <a href="{{ route('catalog.detail', $catalog->slug) }}" class="overlay">
                                    <span>View Details</span>
                                </a>
                            </div>
                            <div class="card-info">
                                <h4>{{ $catalog->name }}</h4>
                                <p>{{ $catalog->origin }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-center">No catalogs available at the moment.</p>
                    @endforelse
                </div>

                @if($catalogs->hasMorePages())
                    <div class="text-center mt-5">
                        <button id="load-more-btn" class="cta-btn" data-page="2">
                            Load More <i class="fas fa-arrow-down ms-2"></i>
                        </button>
                    </div>
                @endif
            </div>
        </section>

        <!-- Featured Masterpiece (Dark/Parallax) -->
        <section class="masterpiece">
            <div class="masterpiece-bg"></div>
            <div class="masterpiece-content reveal-text">
                <span class="section-label">Stone of the Month</span>
                <h2>Calacatta Viola</h2>
                <div class="specs">
                    <div class="spec-item">
                        <span class="label">Origin</span>
                        <span class="value">Carrara, Italy</span>
                    </div>
                    <div class="spec-item">
                        <span class="label">Type</span>
                        <span class="value">Brecciated Marble</span>
                    </div>
                    <div class="spec-item">
                        <span class="label">Application</span>
                        <span class="value">Statement Walls</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Selected Works (Portfolio) - Dark -->
        <section class="portfolio" id="portfolio">
            <div class="container">
                <div class="section-header">
                    <h3>Selected Works</h3>
                    <div class="separator"></div>
                </div>
                <div class="portfolio-grid">
                    <div class="portfolio-item large reveal-card">
                        <img src="{{ asset('assets/images/kitchen.png') }}" alt="Luxury Kitchen">
                        <div class="p-info">
                            <h5>Private Residence</h5>
                            <span>New York, NY</span>
                        </div>
                    </div>
                    <div class="portfolio-item tall reveal-card delay-1">
                        <img src="{{ asset('assets/images/bathroom.png') }}" alt="Luxury Bathroom">
                        <div class="p-info">
                            <h5>Penthouse Spa</h5>
                            <span>Dubai, UAE</span>
                        </div>
                    </div>
                    <div class="portfolio-item wide reveal-card delay-2">
                        <img src="{{ asset('assets/images/showroom.png') }}" alt="Showroom">
                        <div class="p-info">
                            <h5>Flagship Gallery</h5>
                            <span>Milan, Italy</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Services (LIGHT MODE) -->
        <section class="services light-section" id="services">
            <div class="container">
                <div class="services-wrapper">
                    <div class="service-col reveal-text">
                        <span class="num">01</span>
                        <h4>Global Sourcing</h4>
                        <p>We travel to remote quarries to hand-select blocks that meet our rigorous standards for
                            veining and purity.</p>
                    </div>
                    <div class="service-col reveal-text delay-1">
                        <span class="num">02</span>
                        <h4>Custom Fabrication</h4>
                        <p>Our artisans use state-of-the-art waterjet technology combined with hand-finishing to create
                            bespoke pieces.</p>
                    </div>
                    <div class="service-col reveal-text delay-2">
                        <span class="num">03</span>
                        <h4>White-Glove Install</h4>
                        <p>Our dedicated installation team ensures perfection, handling the logistics of moving massive
                            stone slabs.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Process (Dark) -->
        <section class="process" id="process">
            <div class="process-img reveal-image">
                <img src="{{ asset('assets/images/artisan.png') }}" alt="Artisan Working">
            </div>
            <div class="process-text reveal-text">
                <span class="section-label">Craftsmanship</span>
                <h3>The Human Touch</h3>
                <p>While machines cut, only the human hand can truly polish stone to a mirror finish. We honor the
                    tradition of the 'scalpelin' - the master carvers of Italy.</p>
            </div>
        </section>

        <!-- Concierge / Contact (Dark) -->
        <section class="concierge" id="contact">
            <div class="concierge-content reveal-text">
                <h2>Contact Us</h2>
                <p>Ready to start your project? Request a private viewing or get a quote.</p>
                <form class="contact-form" method="POST" action="{{ route('contact.store') }}">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="name" placeholder="Name" required value="{{ old('name') }}">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="tel" name="phone" placeholder="Phone Number" required value="{{ old('phone') }}">
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Email Address" required
                            value="{{ old('email') }}">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <textarea name="message" placeholder="Your Message" rows="3"
                            required>{{ old('message') }}</textarea>
                        @error('message')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit">Submit Request</button>
                </form>
            </div>
        </section>
    </main>

    <footer>
        <div class="footer-grid">
            <div class="footer-col brand-col">
                <div class="logo">LITHOS</div>
                <p>Exquisite stone collections sourced from the world's most exclusive quarries. Elevating interiors
                    since 1985.</p>
            </div>
            <div class="footer-col">
                <h4>Menu</h4>
                <ul>
                    <li><a href="#philosophy">Philosophy</a></li>
                    <li><a href="#collection">Collection</a></li>
                    <li><a href="#portfolio">Projects</a></li>
                    <li><a href="#legacy">Heritage</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Support</h4>
                <ul>
                    <li><a href="#">Stone Care Guide</a></li>
                    <li><a href="#">Shipping & Delivery</a></li>
                    <li><a href="#">Warranty</a></li>
                    <li><a href="#">FAQ</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Contact</h4>
                <p>123 Luxury Ave, Design District<br>Milan, Italy 20121</p>
                <p class="contact-link">+39 02 1234 5678</p>
                <p class="contact-link">concierge@lithos.com</p>
                <div class="social-links">
                    <a href="#">Instagram</a>
                    <a href="#">LinkedIn</a>
                    <a href="#">Pinterest</a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="copyright">&copy; 2024 LITHOS Collection. All rights reserved.</div>
        </div>
    </footer>

    <script>
        // Preloader
        window.addEventListener('load', () => {
            const preloader = document.querySelector('.preloader');
            setTimeout(() => {
                preloader.classList.add('fade-out');
            }, 2000);
        });

        // Intersection Observer
        const observerOptions = {
            threshold: 0.1,
            rootMargin: "0px 0px -50px 0px"
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.reveal-text, .reveal-card, .reveal-image').forEach(el => {
            observer.observe(el);
        });

        // Custom Cursor
        const dot = document.querySelector('.cursor-dot');
        const outline = document.querySelector('.cursor-outline');

        window.addEventListener('mousemove', (e) => {
            const posX = e.clientX;
            const posY = e.clientY;

            dot.style.left = `${posX}px`;
            dot.style.top = `${posY}px`;

            outline.animate({
                left: `${posX}px`,
                top: `${posY}px`
            }, { duration: 500, fill: "forwards" });
        });

        // 3D Tilt Effect for Cards
        document.querySelectorAll('.tilt-card').forEach(card => {
            card.addEventListener('mousemove', (e) => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;

                const centerX = rect.width / 2;
                const centerY = rect.height / 2;

                const rotateX = ((y - centerY) / centerY) * -5;
                const rotateY = ((x - centerX) / centerX) * 5;

                const img = card.querySelector('img');
                img.style.transform = `scale(1.1) perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
            });

            card.addEventListener('mouseleave', () => {
                const img = card.querySelector('img');
                img.style.transform = `scale(1) perspective(1000px) rotateX(0) rotateY(0)`;
            });
        });

        // Load More Functionality
        const loadMoreBtn = document.getElementById('load-more-btn');
        if (loadMoreBtn) {
            loadMoreBtn.addEventListener('click', function() {
                const page = this.getAttribute('data-page');
                const btn = this;
                
                btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Loading...';
                btn.disabled = true;

                fetch(`/?page=${page}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    const grid = document.getElementById('catalog-grid');
                    const tempDiv = document.createElement('div');
                    tempDiv.innerHTML = data.html;
                    
                    // Append new cards
                    while (tempDiv.firstChild) {
                        grid.appendChild(tempDiv.firstChild);
                    }

                    // Update button
                    if (data.hasMore) {
                        btn.setAttribute('data-page', parseInt(page) + 1);
                        btn.innerHTML = 'Load More <i class="fas fa-arrow-down ms-2"></i>';
                        btn.disabled = false;
                    } else {
                        btn.remove();
                    }

                    // Re-observe new cards for animations
                    document.querySelectorAll('.reveal-card').forEach(el => {
                        observer.observe(el);
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                    btn.innerHTML = 'Load More <i class="fas fa-arrow-down ms-2"></i>';
                    btn.disabled = false;
                });
            });
        }
    </script>
</body>

</html>