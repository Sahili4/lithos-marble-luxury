@extends('admin.layouts.app')

@section('title', 'Contact Messages')
@section('page-title', 'Contact Messages')

@section('content')
    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">All Messages</h5>
            <div class="btn-group" role="group">
                <a href="{{ route('admin.messages.index') }}"
                    class="btn btn-sm {{ !request('filter') ? 'btn-primary' : 'btn-outline-primary' }}">All</a>
                <a href="{{ route('admin.messages.index', ['filter' => 'unread']) }}"
                    class="btn btn-sm {{ request('filter') == 'unread' ? 'btn-primary' : 'btn-outline-primary' }}">Unread</a>
                <a href="{{ route('admin.messages.index', ['filter' => 'read']) }}"
                    class="btn btn-sm {{ request('filter') == 'read' ? 'btn-primary' : 'btn-outline-primary' }}">Read</a>
            </div>
        </div>
        <div class="card-body">
            @if($messages->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover" id="messagesTable">
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Message</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($messages as $message)
                                <tr class="{{ !$message->is_read ? 'table-warning' : '' }}">
                                    <td>
                                        @if($message->is_read)
                                            <i class="fas fa-envelope-open text-success"></i>
                                        @else
                                            <i class="fas fa-envelope text-warning"></i>
                                        @endif
                                    </td>
                                    <td><strong>{{ $message->name }}</strong></td>
                                    <td>{{ $message->email }}</td>
                                    <td>{{ $message->phone }}</td>
                                    <td>{{ Str::limit($message->message, 60) }}</td>
                                    <td>{{ $message->created_at->format('M d, Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('admin.messages.show', $message) }}" class="btn btn-sm btn-primary"
                                            title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form action="{{ route('admin.messages.toggle-read', $message) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-info"
                                                title="{{ $message->is_read ? 'Mark as Unread' : 'Mark as Read' }}">
                                                <i class="fas fa-{{ $message->is_read ? 'envelope' : 'envelope-open' }}"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.messages.destroy', $message) }}" method="POST"
                                            class="d-inline" id="delete-form-{{ $message->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-danger"
                                                onclick="confirmDelete('delete-form-{{ $message->id }}')" title="Delete">
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
                    {{ $messages->links() }}
                </div>
            @else
                <p class="text-muted text-center mb-0">No messages found.</p>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#messagesTable').DataTable({
                "paging": false,
                "ordering": true,
                "info": false,
                "searching": true,
                "order": [[5, "desc"]]
            });
        });
    </script>
@endpush