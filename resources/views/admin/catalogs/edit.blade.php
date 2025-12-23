@extends('admin.layouts.app')

@section('title', 'Edit Catalog')
@section('page-title', 'Edit Catalog')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0">Edit: {{ $catalog->name }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.catalogs.update', $catalog) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name', $catalog->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="origin" class="form-label">Origin</label>
                        <input type="text" class="form-control @error('origin') is-invalid @enderror" 
                               id="origin" name="origin" value="{{ old('origin', $catalog->origin) }}">
                        @error('origin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="4">{{ old('description', $catalog->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="type" class="form-label">Type</label>
                            <input type="text" class="form-control @error('type') is-invalid @enderror" 
                                   id="type" name="type" value="{{ old('type', $catalog->type) }}">
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="application" class="form-label">Application</label>
                            <input type="text" class="form-control @error('application') is-invalid @enderror" 
                                   id="application" name="application" value="{{ old('application', $catalog->application) }}">
                            @error('application')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        @if($catalog->image)
                            <div class="mb-2">
                                <img src="{{ asset($catalog->image) }}" alt="{{ $catalog->name }}" class="image-preview" style="display: block;">
                            </div>
                        @endif
                        <input type="file" class="form-control @error('image') is-invalid @enderror" 
                               id="image" name="image" accept="image/*" onchange="previewImage(this)">
                        <small class="text-muted">Leave empty to keep current image</small>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <img id="image-preview" class="image-preview" style="display: none;">
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="sort_order" class="form-label">Sort Order</label>
                            <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                                   id="sort_order" name="sort_order" value="{{ old('sort_order', $catalog->sort_order) }}">
                            @error('sort_order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label d-block">Featured</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="is_featured" 
                                       name="is_featured" value="1" {{ old('is_featured', $catalog->is_featured) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_featured">Mark as featured</label>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label d-block">Status</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="status" 
                                       name="status" value="1" {{ old('status', $catalog->status) ? 'checked' : '' }}>
                                <label class="form-check-label" for="status">Active</label>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Update Catalog
                        </button>
                        <a href="{{ route('admin.catalogs.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
