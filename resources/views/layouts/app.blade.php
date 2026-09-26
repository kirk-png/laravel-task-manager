<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Personal Task Manager')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
        }
        .navbar-brand i {
            color: #6366f1;
        }
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
        }
        .stat-card {
            border-radius: 12px;
            color: #fff;
            padding: 1.25rem;
        }
        .stat-card.total { background: linear-gradient(135deg, #6366f1, #818cf8); }
        .stat-card.pending { background: linear-gradient(135deg, #f59e0b, #fbbf24); }
        .stat-card.completed { background: linear-gradient(135deg, #10b981, #34d399); }
        .badge-status-pending {
            background-color: #fef3c7;
            color: #92400e;
        }
        .badge-status-completed {
            background-color: #d1fae5;
            color: #065f46;
        }
        .table thead th {
            border-bottom: 2px solid #eee;
            color: #6b7280;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }
        .btn-soft-primary { background-color: #eef2ff; color: #4f46e5; border: none; }
        .btn-soft-primary:hover { background-color: #e0e7ff; color: #4338ca; }
        .btn-soft-danger { background-color: #fee2e2; color: #b91c1c; border: none; }
        .btn-soft-danger:hover { background-color: #fecaca; color: #991b1b; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('tasks.index') }}">
                <i class="fa-solid fa-list-check me-2"></i>Personal Task Manager
            </a>
            <div class="ms-auto">
                <a href="{{ route('tasks.create') }}" class="btn btn-primary">
                    <i class="fa-solid fa-plus me-1"></i> Add Task
                </a>
            </div>
        </div>
    </nav>

    <div class="container pb-5">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
