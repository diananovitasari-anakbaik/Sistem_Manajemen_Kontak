<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'KONTAK' }}</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <style>
        :root {
            --primary-blue: #1e3a8a;
            --secondary-blue: #3b82f6;
            --light-blue: #dbeafe;
            --white: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #1e3a8a 0%, #0e0e28ff 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Navbar */
        .navbar {
            background-color: var(--primary-blue);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            padding: 1rem 0;
        }

        .navbar-brand {
            color: var(--white) !important;
            font-weight: bold;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .navbar-brand i {
            font-size: 1.75rem;
            color: var(--secondary-blue);
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.85) !important;
            margin: 0 0.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: var(--white) !important;
        }

        .dropdown-menu {
            background-color: var(--white);
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .dropdown-item {
            color: #333;
            padding: 0.75rem 1.5rem;
        }

        .dropdown-item:hover {
            background-color: var(--light-blue);
            color: var(--primary-blue);
        }

        /* Main Content */
        main {
            flex: 1;
            padding: 2rem 0;
        }

        .container {
            max-width: 1200px;
            background-color: var(--white);
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: var(--primary-blue);
            font-weight: bold;
        }

        .text-secondary {
            color: var(--primary-blue) !important;
        }

        /* Table */
        .table {
            background-color: var(--white);
            border-radius: 10px;
            overflow: hidden;
        }

        .table thead {
            background-color: var(--primary-blue);
            color: var(--white);
        }

        .table thead th {
            border: none;
            padding: 1rem;
            font-weight: 600;
        }

        .table tbody td {
            border-color: #e5e7eb;
            padding: 1rem;
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background-color: rgba(59, 130, 246, 0.05);
        }

        /* Cards */
        .card {
            background-color: var(--white);
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(85, 0, 253, 0.1);
            overflow: hidden;
        }

        .card-header {
            background-color: var(--primary-blue);
            color: var(--white);
            border: none;
            padding: 1.25rem;
        }

        .card-header h5 {
            margin: 0;
            font-weight: 600;
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Buttons */
        .btn-custom {
            background-color: var(--secondary-blue);
            color: var(--white);
            border: none;
            font-weight: 600;
            transition: all 0.3s ease;
            padding: 0.5rem 1.25rem;
            border-radius: 6px;
        }

        .btn-custom:hover {
            background-color: var(--primary-blue);
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(30, 58, 138, 0.3);
        }

        .btn-warning {
            background-color: #fbbf24;
            color: #000;
            border: none;
            font-weight: 600;
        }

        .btn-warning:hover {
            background-color: #f59e0b;
            color: #000;
        }

        .btn-danger {
            background-color: #ef4444;
            color: var(--white);
            border: none;
            font-weight: 600;
        }

        .btn-danger:hover {
            background-color: #dc2626;
        }

        .btn-secondary {
            background-color: #6b7280;
            color: var(--white);
            border: none;
        }

        .btn-secondary:hover {
            background-color: #4b5563;
        }

        .btn-sm {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
        }

        /* Forms */
        .form-control, .form-select {
            border: 1px solid #d1d5db;
            border-radius: 6px;
            padding: 0.625rem 0.875rem;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--secondary-blue);
            box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.25);
        }

        .form-label {
            color: var(--primary-blue);
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        /* Alerts */
        .alert {
            border-radius: 8px;
            border: none;
        }

        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
        }

        .alert-danger {
            background-color: #fee2e2;
            color: #7f1d1d;
        }

        .alert-warning {
            background-color: #fef3c7;
            color: #92400e;
        }

        /* Footer */
        footer {
            background-color: var(--primary-blue);
            color: var(--white);
            padding: 2rem 0;
            margin-top: 2rem;
            text-align: center;
        }

        footer p {
            margin: 0;
        }

        /* Pagination */
        .pagination {
            gap: 0.5rem;
        }

        .page-link {
            color: var(--secondary-blue);
            border-color: #d1d5db;
            border-radius: 6px;
        }

        .page-link:hover {
            background-color: var(--light-blue);
            border-color: var(--secondary-blue);
        }

        .page-item.active .page-link {
            background-color: var(--secondary-blue);
            border-color: var(--secondary-blue);
        }

        .text-end {
            text-align: right;
        }

        .table-responsive {
            border-radius: 10px;
        }

        /* KHUSUS LOGIN – hilangkan kotak putih besar */
        .login-page main .container {
            background: transparent !important;
            box-shadow: none !important;
            padding: 0 !important;
        }

        

    </style>
</head>

<body class="{{ $bodyClass ?? '' }}">


    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid px-4">
            <a class="navbar-brand" href="/">
                <i class="bi bi-telephone-fill"></i>
                KONTAK
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>

                    </li>
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link btn btn-custom ms-2" href="/login">Login</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        <div class="container">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong><i class="bi bi-exclamation-triangle"></i> Error!</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{ $slot }}
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <div class="container-fluid">
            <p>&copy; 2025 <strong>KONTAK</strong> Management System. Adela, Andien, Diana .</p>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>