<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full" style="background: #FBF3F5;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') — Al-Noor School Fee Management</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Inter', sans-serif; background: #FBF3F5; color: #3A2E36; }

        /* Cards */
        .card {
            background: #fff;
            border-radius: 1rem;
            border: 1px solid #F2D5E0;
            box-shadow: 0 2px 8px rgba(92, 64, 86, 0.06);
        }

        /* Table header */
        .table-head {
            background: #FBF3F5;
            color: #7A6B72;
        }

        /* Buttons */
        .btn-primary {
            background: #5C2A3E;
            color: #fff;
            transition: all 0.18s ease;
        }
        .btn-primary:hover {
            background: #4A2232;
            transform: translateY(-1px);
            box-shadow: 0 4px 14px rgba(92, 42, 62, 0.3);
        }

        /* Input focus ring */
        input:focus, select:focus, textarea:focus {
            border-color: #5C2A3E !important;
            box-shadow: 0 0 0 3px rgba(92, 42, 62, 0.12) !important;
            outline: none !important;
        }
    </style>
</head>
<body class="h-full" style="color: #3A2E36;">
    <div class="min-h-full flex flex-col">
        <!-- Main content -->
        <div class="flex-1 flex flex-col">
            <!-- Main wrapper -->
            <main class="flex-1 p-6 md:p-8" style="background: #FBF3F5;">
                <!-- Content -->
                @yield('content')
            </main>
        </div>
    </div>

    @yield('scripts')
</body>
</html>
