@extends('admin.layouts.app')

@section('title', 'Manage Catalogs')
@section('page-title', 'Manage Catalogs')

@section('content')
    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">All Catalogs</h5>
            <a href="{{ route('admin.catalogs.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Add New Catalog
            </a>
        </div>
        <div class="card-body">
            @if($catalogs->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover" id="catalogsTable">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Origin</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Featured</th>
                                <th>Order</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($catalogs as $catalog)
                                <tr>
                                    <td>
                                        <img src="{{ asset($catalog->image) }}" alt="{{ $catalog->name }}"
                                            style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;">
                                    </td>
                                    <td><strong>{{ $catalog->name }}</strong></td>
                                    <td>{{ $catalog->origin }}</td>
                                    <td>{{ $catalog->type ?? 'N/A' }}</td>
                                    <td>
                                        @if($catalog->status)
                                            <span class="badge bg-success badge-status">Active</span>
                                        @else
                                            <span class="badge bg-secondary badge-status">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($catalog->is_featured)
                                            <i class="fas fa-star text-warning"></i>
                                        @else
                                            <i class="far fa-star text-muted"></i>
                                        @endif
                                    </td>
                                    <td>{{ $catalog->sort_order }}</td>
                                    <td>
                                        <a href="{{ route('admin.catalogs.edit', $catalog) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.catalogs.destroy', $catalog) }}" method="POST"
                                            class="d-inline" id="delete-form-{{ $catalog->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-danger"
                                                onclick="confirmDelete('delete-form-{{ $catalog->id }}')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    {{ $catalogs->links() }}
                </div>
            @else
                <p class="text-muted text-center mb-0">No catalogs found. <a href="{{ route('admin.catalogs.create') }}">Create
                        one now</a></p>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#catalogsTable').DataTable({
                "paging": false,
                "ordering": true,
                "info": false,
                "searching": true
            });
        });
    </script>
@endpush