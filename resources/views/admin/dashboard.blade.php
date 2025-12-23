@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="stat-card primary">
                <div class="icon">
                    <i class="fas fa-gem"></i>
                </div>
                <h3 class="mb-1">{{ $stats['total_catalogs'] }}</h3>
                <p class="text-muted mb-0">Total Catalogs</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card success">
                <div class="icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h3 class="mb-1">{{ $stats['active_catalogs'] }}</h3>
                <p class="text-muted mb-0">Active Catalogs</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card warning">
                <div class="icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <h3 class="mb-1">{{ $stats['total_messages'] }}</h3>
                <p class="text-muted mb-0">Total Messages</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card danger">
                <div class="icon">
                    <i class="fas fa-envelope-open"></i>
                </div>
                <h3 class="mb-1">{{ $stats['unread_messages'] }}</h3>
                <p class="text-muted mb-0">Unread Messages</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Recent Contact Messages</h5>
                </div>
                <div class="card-body">
                    @if($recent_messages->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Message</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recent_messages as $message)
                                        <tr>
                                            <td>{{ $message->name }}</td>
                                            <td>{{ $message->email }}</td>
                                            <td>{{ $message->phone }}</td>
                                            <td>{{ Str::limit($message->message, 50) }}</td>
                                            <td>
                                                @if($message->is_read)
                                                    <span class="badge bg-success badge-status">Read</span>
                                                @else
                                                    <span class="badge bg-warning badge-status">Unread</span>
                                                @endif
                                            </td>
                                            <td>{{ $message->created_at->diffForHumans() }}</td>
                                            <td>
                                                <a href="{{ route('admin.messages.show', $message) }}"
                                                    class="btn btn-sm btn-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center mt-3">
                            <a href="{{ route('admin.messages.index') }}" class="btn btn-outline-primary">View All Messages</a>
                        </div>
                    @else
                        <p class="text-muted text-center mb-0">No messages yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection