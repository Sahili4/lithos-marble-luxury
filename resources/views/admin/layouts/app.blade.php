<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - LITHOS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <style>
        :root {
            --sidebar-width: 260px;
            --primary-color: #2c3e50;
            --accent-color: #c9a961;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8f9fa;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: var(--primary-color);
            color: white;
            overflow-y: auto;
            z-index: 1000;
        }

        .sidebar-brand {
            padding: 1.5rem;
            font-size: 1.5rem;
            font-weight: 600;
            letter-spacing: 2px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-nav {
            padding: 1rem 0;
        }

        .sidebar-nav a {
            display: flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s;
        }

        .sidebar-nav a:hover,
        .sidebar-nav a.active {
            background: rgba(255, 255, 255, 0.1);
            color: var(--accent-color);
        }

        .sidebar-nav a i {
            width: 20px;
            margin-right: 10px;
        }

        .main-content {
            margin-left: var(--sidebar-width);
            padding: 2rem;
        }

        .top-bar {
            background: white;
            padding: 1rem 2rem;
            margin: -2rem -2rem 2rem -2rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-card .icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .stat-card.primary .icon {
            background: rgba(13, 110, 253, 0.1);
            color: #0d6efd;
        }

        .stat-card.success .icon {
            background: rgba(25, 135, 84, 0.1);
            color: #198754;
        }

        .stat-card.warning .icon {
            background: rgba(255, 193, 7, 0.1);
            color: #ffc107;
        }

        .stat-card.danger .icon {
            background: rgba(220, 53, 69, 0.1);
            color: #dc3545;
        }

        .btn-primary {
            background: var(--accent-color);
            border-color: var(--accent-color);
        }

        .btn-primary:hover {
            background: #b89850;
            border-color: #b89850;
        }

        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .badge-status {
            padding: 0.35rem 0.65rem;
            border-radius: 20px;
        }

        .image-preview {
            max-width: 200px;
            max-height: 200px;
            margin-top: 10px;
            border-radius: 8px;
        }
    </style>
    @stack('styles')
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-brand">LITHOS</div>
        <nav class="sidebar-nav">
            <a href="{{ route('admin.dashboard') }}"
                class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-chart-line"></i> Dashboard
            </a>
            <a href="{{ route('admin.catalogs.index') }}"
                class="{{ request()->routeIs('admin.catalogs.*') ? 'active' : '' }}">
                <i class="fas fa-gem"></i> Catalogs
            </a>
            <a href="{{ route('admin.messages.index') }}"
                class="{{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
                <i class="fas fa-envelope"></i> Messages
            </a>
            <a href="{{ route('admin.settings.index') }}"
                class="{{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                <i class="fas fa-cog"></i> Settings
            </a>
            <a href="{{ route('home') }}" target="_blank">
                <i class="fas fa-external-link-alt"></i> View Website
            </a>
            <hr style="border-color: rgba(255,255,255,0.1); margin: 1rem 0;">
            <a href="{{ route('profile.edit') }}">
                <i class="fas fa-user-cog"></i> Profile
            </a>
            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                @csrf
                <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </form>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="top-bar">
            <h4 class="mb-0">@yield('page-title', 'Dashboard')</h4>
            <div>
                <span class="text-muted">Welcome, {{ auth()->user()->name }}</span>
            </div>
        </div>

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Confirm delete
        function confirmDelete(formId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });
        }

        // Image preview
        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const preview = document.getElementById('image-preview');
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    @stack('scripts')
</body>

</html>