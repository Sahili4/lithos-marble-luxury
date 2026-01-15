@extends('admin.layouts.app')

@section('title', 'Site Settings')
@section('page-title', 'Site Settings')

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Contact Settings -->
                <div class="card mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0"><i class="fas fa-phone me-2"></i>Contact Settings</h5>
                    </div>
                    <div class="card-body">
                        @if(isset($settings['contact']))
                            @foreach($settings['contact'] as $setting)
                                <div class="mb-3">
                                    <label for="{{ $setting->key }}" class="form-label">
                                        {{ ucwords(str_replace('_', ' ', $setting->key)) }}
                                    </label>

                                    @if($setting->type === 'textarea')
                                        <textarea class="form-control" id="{{ $setting->key }}" name="settings[{{ $setting->key }}]"
                                            rows="3">{{ old('settings.' . $setting->key, $setting->value) }}</textarea>
                                        @if($setting->key === 'whatsapp_message')
                                            <small class="text-muted">
                                                Use {product_name} and {product_url} as placeholders
                                            </small>
                                        @endif
                                    @elseif($setting->type === 'image')
                                        <div class="d-flex align-items-center gap-3">
                                            @if($setting->value)
                                                <img src="{{ asset($setting->value) }}" alt="Current Logo"
                                                    style="max-height: 50px; background: #eee; padding: 5px;">
                                            @endif
                                            <input type="file" class="form-control" id="{{ $setting->key }}"
                                                name="images[{{ $setting->key }}]" accept="image/*">
                                        </div>
                                    @else
                                        <input type="{{ $setting->type === 'number' ? 'number' : 'text' }}" class="form-control"
                                            id="{{ $setting->key }}" name="settings[{{ $setting->key }}]"
                                            value="{{ old('settings.' . $setting->key, $setting->value) }}">
                                        @if($setting->key === 'whatsapp_number')
                                            <small class="text-muted">
                                                Enter with country code (e.g., 919876543210 for India)
                                            </small>
                                        @endif
                                    @endif
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <!-- General Settings -->
                <div class="card mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0"><i class="fas fa-cog me-2"></i>General Settings</h5>
                    </div>
                    <div class="card-body">
                        @if(isset($settings['general']))
                            @foreach($settings['general'] as $setting)
                                <div class="mb-3">
                                    <label for="{{ $setting->key }}" class="form-label">
                                        {{ ucwords(str_replace('_', ' ', $setting->key)) }}
                                    </label>

                                    @if($setting->type === 'image')
                                        <div class="d-flex align-items-center gap-3">
                                            @if($setting->value)
                                                <img src="{{ asset($setting->value) }}" alt="Current Logo"
                                                    style="max-height: 50px; background: #eee; padding: 5px;">
                                            @endif
                                            <input type="file" class="form-control" id="{{ $setting->key }}"
                                                name="images[{{ $setting->key }}]" accept="image/*">
                                        </div>
                                    @else
                                        <input type="{{ $setting->type === 'number' ? 'number' : 'text' }}" class="form-control"
                                            id="{{ $setting->key }}" name="settings[{{ $setting->key }}]"
                                            value="{{ old('settings.' . $setting->key, $setting->value) }}">
                                        @if($setting->key === 'catalogs_per_page')
                                            <small class="text-muted">
                                                Number of catalogs to show initially on homepage
                                            </small>
                                        @endif
                                    @endif
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Save Settings
                    </button>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Help</h5>
                </div>
                <div class="card-body">
                    <h6>WhatsApp Number</h6>
                    <p class="small">Enter your WhatsApp business number with country code, without + or spaces.</p>
                    <p class="small"><strong>Examples:</strong></p>
                    <ul class="small">
                        <li>India: 919876543210</li>
                        <li>USA: 14155552671</li>
                        <li>UAE: 971501234567</li>
                    </ul>

                    <hr>

                    <h6>WhatsApp Message</h6>
                    <p class="small">Customize the pre-filled message. Use these placeholders:</p>
                    <ul class="small">
                        <li><code>{product_name}</code> - Product name</li>
                        <li><code>{product_url}</code> - Product page URL</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection