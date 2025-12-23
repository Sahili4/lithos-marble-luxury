@extends('admin.layouts.app')

@section('title', 'View Message')
@section('page-title', 'Message Details')

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Message from {{ $message->name }}</h5>
                    <div>
                        <form action="{{ route('admin.messages.toggle-read', $message) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-info">
                                <i class="fas fa-{{ $message->is_read ? 'envelope' : 'envelope-open' }} me-1"></i>
                                Mark as {{ $message->is_read ? 'Unread' : 'Read' }}
                            </button>
                        </form>
                        <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" class="d-inline"
                            id="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete('delete-form')">
                                <i class="fas fa-trash me-1"></i>Delete
                            </button>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Name:</strong></p>
                            <p>{{ $message->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Email:</strong></p>
                            <p><a href="mailto:{{ $message->email }}">{{ $message->email }}</a></p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Phone:</strong></p>
                            <p><a href="tel:{{ $message->phone }}">{{ $message->phone }}</a></p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Received:</strong></p>
                            <p>{{ $message->created_at->format('M d, Y \a\t H:i') }}</p>
                        </div>
                    </div>

                    <div class="mb-3">
                        <p class="mb-1"><strong>IP Address:</strong></p>
                        <p>{{ $message->ip_address }}</p>
                    </div>

                    <hr>

                    <div>
                        <p class="mb-2"><strong>Message:</strong></p>
                        <div class="p-3 bg-light rounded">
                            {{ $message->message }}
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('admin.messages.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Messages
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection