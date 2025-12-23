<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $catalog->name }} | LITHOS</title>
    <meta name="description"
        content="{{ $catalog->description ?? 'Exquisite ' . $catalog->name . ' from ' . $catalog->origin }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;1,400&family=Montserrat:wght@300;400;500&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .detail-section {
            min-height: 100vh;
            background: #1a1a1a;
            color: white;
            padding: 100px 0 50px;
        }

        .detail-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
            margin-bottom: 4rem;
        }

        .detail-image {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
        }

        .detail-image img {
            width: 100%;
            height: auto;
            display: block;
        }

        .detail-content h1 {
            font-family: 'Playfair Display', serif;
            font-size: 3.5rem;
            margin-bottom: 1rem;
            color: #c9a961;
        }

        .detail-origin {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .detail-description {
            font-size: 1.1rem;
            line-height: 1.8;
            margin-bottom: 2rem;
            color: rgba(255, 255, 255, 0.9);
        }

        .detail-specs {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
        }

        .spec-box {
            background: rgba(255, 255, 255, 0.05);
            padding: 1.5rem;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .spec-box label {
            display: block;
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.6);
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .spec-box value {
            display: block;
            font-size: 1.2rem;
            color: white;
            font-weight: 500;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .whatsapp-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem 2rem;
            background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 500;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(37, 211, 102, 0.4);
        }

        .whatsapp-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(37, 211, 102, 0.6);
            color: white;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem 2rem;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 500;
            transition: all 0.3s;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .back-btn:hover {
            background: rgba(255, 255, 255, 0.15);
            color: white;
        }

        .related-section {
            padding: 3rem 0;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .related-section h3 {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            margin-bottom: 2rem;
            text-align: center;
        }

        .related-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .related-card {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .related-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        .related-card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .related-card-info {
            padding: 1.5rem;
        }

        .related-card-info h4 {
            font-size: 1.3rem;
            margin-bottom: 0.5rem;
        }

        .related-card-info p {
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 1rem;
        }

        .related-card-info a {
            color: #c9a961;
            text-decoration: none;
            font-weight: 500;
        }

        .related-card-info a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .detail-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .detail-content h1 {
                font-size: 2.5rem;
            }
        }
    </style>
</head>

<body>
    <header>
        <nav>
            <div class="logo">LITHOS</div>
            <ul class="nav-links">
                <li><a href="{{ route('home') }}#philosophy">Philosophy</a></li>
                <li><a href="{{ route('home') }}#legacy">Heritage</a></li>
                <li><a href="{{ route('home') }}#collection">Collection</a></li>
                <li><a href="{{ route('home') }}#portfolio">Projects</a></li>
                <li><a href="{{ route('home') }}#contact">Contact</a></li>
            </ul>
            <div class="menu-btn-mobile">Menu</div>
        </nav>
    </header>

    <section class="detail-section">
        <div class="detail-container">
            <div class="detail-grid">
                <div class="detail-image">
                    <img src="{{ asset($catalog->image) }}" alt="{{ $catalog->name }}">
                </div>

                <div class="detail-content">
                    <h1>{{ $catalog->name }}</h1>
                    <div class="detail-origin">
                        <i class="fas fa-map-marker-alt"></i>
                        {{ $catalog->origin }}
                    </div>

                    @if($catalog->description)
                        <p class="detail-description">{{ $catalog->description }}</p>
                    @endif

                    <div class="detail-specs">
                        @if($catalog->type)
                            <div class="spec-box">
                                <label>Type</label>
                                <value>{{ $catalog->type }}</value>
                            </div>
                        @endif

                        @if($catalog->application)
                            <div class="spec-box">
                                <label>Application</label>
                                <value>{{ $catalog->application }}</value>
                            </div>
                        @endif

                        <div class="spec-box">
                            <label>Origin</label>
                            <value>{{ $catalog->origin }}</value>
                        </div>
                    </div>

                    <div class="action-buttons">
                        @php
                            $whatsappNumber = \App\Models\Setting::get('whatsapp_number', '919876543210');
                            $whatsappMessage = \App\Models\Setting::get('whatsapp_message', "Hi, I'm interested in {product_name}. {product_url}");
                            $productUrl = url()->current();
                            $message = str_replace(
                                ['{product_name}', '{product_url}'],
                                [$catalog->name, $productUrl],
                                $whatsappMessage
                            );
                        @endphp
                        <a href="https://wa.me/{{ $whatsappNumber }}?text={{ urlencode($message) }}"
                            class="whatsapp-btn" target="_blank">
                            <i class="fab fa-whatsapp"></i>
                            Contact on WhatsApp
                        </a>
                        <a href="{{ route('home') }}#collection" class="back-btn">
                            <i class="fas fa-arrow-left"></i>
                            Back to Collection
                        </a>
                    </div>
                </div>
            </div>

            @if($related_catalogs->count() > 0)
                <div class="related-section">
                    <h3>You May Also Like</h3>
                    <div class="related-grid">
                        @foreach($related_catalogs as $related)
                            <div class="related-card">
                                <img src="{{ asset($related->image) }}" alt="{{ $related->name }}">
                                <div class="related-card-info">
                                    <h4>{{ $related->name }}</h4>
                                    <p>{{ $related->origin }}</p>
                                    <a href="{{ route('catalog.detail', $related->slug) }}">
                                        View Details <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>

    <footer>
        <div class="footer-grid">
            <div class="footer-col brand-col">
                <div class="logo">LITHOS</div>
                <p>Exquisite stone collections sourced from the world's most exclusive quarries.</p>
            </div>
            <div class="footer-col">
                <h4>Menu</h4>
                <ul>
                    <li><a href="{{ route('home') }}#philosophy">Philosophy</a></li>
                    <li><a href="{{ route('home') }}#collection">Collection</a></li>
                    <li><a href="{{ route('home') }}#portfolio">Projects</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Contact</h4>
                <p>123 Luxury Ave, Design District<br>Milan, Italy 20121</p>
                <p class="contact-link">+39 02 1234 5678</p>
                <p class="contact-link">concierge@lithos.com</p>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="copyright">&copy; 2024 LITHOS Collection. All rights reserved.</div>
        </div>
    </footer>
</body>

</html>