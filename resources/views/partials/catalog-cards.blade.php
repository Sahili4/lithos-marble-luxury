@foreach($catalogs as $index => $catalog)
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
            <a href="https://wa.me/{{ $whatsappNumber }}?text={{ urlencode($message) }}" class="whatsapp-icon"
                target="_blank" title="Contact us on WhatsApp">
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
@endforeach