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

        /* Sidebar */
        #sidebar { background: #5C2A3E; }
        .sidebar-brand { border-bottom: 1px solid rgba(255,255,255,0.1); }
        .sidebar-logo { background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.2); }

        /* Nav links */
        .nav-link {
            color: rgba(255,255,255,0.75);
            transition: all 0.18s ease;
            border-radius: 0.75rem;
        }
        .nav-link:hover {
            background: rgba(255,255,255,0.1);
            color: #fff;
        }
        .nav-link.active {
            background: #C98A9E;
            color: #fff;
            box-shadow: 0 4px 14px rgba(92, 42, 62, 0.4);
        }

        /* Main content */
        .main-header {
            background: #fff;
            border-bottom: 1px solid #F2D5E0;
        }

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

        /* Badge colors */
        .badge-payment  { background: #EEF7EE; color: #4A7A45; border: 1px solid #A9C9A4; }
        .badge-fine     { background: #FFF0F0; color: #8B3A3A; border: 1px solid #F4A0A0; }
        .badge-concession { background: #FDF0F5; color: #7D3B5A; border: 1px solid #C98A9E; }

        /* Flash messages */
        .flash-success { background: #EEF7EE; border: 1px solid #A9C9A4; color: #3A5A38; }
        .flash-error   { background: #FFF0F0; border: 1px solid #F4A0A0; color: #8B3A3A; }

        /* Sidebar bottom user card */
        .sidebar-user-card { background: rgba(255,255,255,0.08); border-radius: 0.75rem; }
        .sidebar-avatar { background: #C98A9E; color: #5C2A3E; }
        .logout-btn { color: #D9A99A; transition: all 0.18s ease; border-radius: 0.75rem; }
        .logout-btn:hover { background: rgba(244, 160, 160, 0.2); color: #F4A0A0; }

        /* Input focus ring */
        input:focus, select:focus, textarea:focus {
            border-color: #5C2A3E !important;
            box-shadow: 0 0 0 3px rgba(92, 42, 62, 0.12) !important;
            outline: none !important;
        }

        /* Pagination override */
        nav[role="navigation"] a, nav[role="navigation"] span {
            border-color: #D9A99A !important;
            color: #5C2A3E !important;
        }
        nav[role="navigation"] a:hover {
            background: #D9A99A !important;
        }
        nav[role="navigation"] [aria-current="page"] span,
        nav[role="navigation"] span[aria-current="page"] {
            background: #5C2A3E !important;
            color: #fff !important;
            border-color: #5C2A3E !important;
        }
    </style>
</head>
<body class="h-full" style="color: #3A2E36;">
    <div class="min-h-full flex flex-col md:flex-row">
        <!-- Backdrop for mobile sidebar -->
        <div id="mobile-sidebar-backdrop" class="fixed inset-0 z-40 hidden md:hidden" style="background: rgba(58,46,54,0.5);" onclick="toggleMobileSidebar()"></div>

        <!-- Sidebar -->
        <aside id="sidebar" class="fixed inset-y-0 left-0 z-50 flex w-72 flex-col transform -translate-x-full transition-transform duration-300 ease-in-out md:translate-x-0 md:static md:flex md:h-screen">
            <!-- Brand -->
            <div class="sidebar-brand flex h-16 items-center px-6 gap-3">
                <div class="sidebar-logo h-10 w-10 flex items-center justify-center rounded-xl text-white flex-shrink-0">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.57 50.57 0 0 0-2.658-.813A5.905 5.905 0 0 1 1.091 7.497 4.907 4.907 0 0 1 6.18 4.25a5.002 5.002 0 0 1 6.03 1.07 5.002 5.002 0 0 1 6.03-1.07 4.907 4.907 0 0 1 5.087 3.247 5.905 5.905 0 0 1-3.413 2.657 50.567 50.567 0 0 0-2.658.813M4.26 10.147a48.674 48.674 0 0 0 15.48 0" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-base font-bold text-white leading-none">Al-Noor School</h1>
                    <span class="text-xs font-medium" style="color: #C98A9E;">Fee Management</span>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 space-y-1 px-4 py-6 overflow-y-auto">
                <a href="{{ route('dashboard') }}"
                   class="nav-link flex items-center gap-3 px-4 py-3 text-sm font-semibold {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <svg class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                    </svg>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('students.index') }}"
                   class="nav-link flex items-center gap-3 px-4 py-3 text-sm font-semibold {{ request()->routeIs('students.*') ? 'active' : '' }}">
                    <svg class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.57 50.57 0 0 0-2.658-.813A5.905 5.905 0 0 1 1.091 7.497 4.907 4.907 0 0 1 6.18 4.25a5.002 5.002 0 0 1 6.03 1.07 5.002 5.002 0 0 1 6.03-1.07 4.907 4.907 0 0 1 5.087 3.247 5.905 5.905 0 0 1-3.413 2.657 50.567 50.567 0 0 0-2.658.813M4.26 10.147a48.674 48.674 0 0 0 15.48 0m-15.48 0a50.584 50.584 0 0 1 15.48 0M6.75 11.25a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0Z" />
                    </svg>
                    <span>Students</span>
                </a>

                <a href="{{ route('fee-structures.index') }}"
                   class="nav-link flex items-center gap-3 px-4 py-3 text-sm font-semibold {{ request()->routeIs('fee-structures.*') ? 'active' : '' }}">
                    <svg class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <span>Fee Structures</span>
                </a>

                <a href="{{ route('transactions.index') }}"
                   class="nav-link flex items-center gap-3 px-4 py-3 text-sm font-semibold {{ request()->routeIs('transactions.*') ? 'active' : '' }}">
                    <svg class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                    </svg>
                    <span>Transactions</span>
                </a>
            </nav>

            <!-- Bottom: User + Logout -->
            <div class="p-4" style="border-top: 1px solid rgba(255,255,255,0.1);">
                <div class="sidebar-user-card flex items-center gap-3 px-3 py-3 mb-3 overflow-hidden">
                    <div class="sidebar-avatar h-9 w-9 flex-shrink-0 rounded-full flex items-center justify-center font-bold text-sm">
                        {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs font-semibold text-white truncate">{{ Auth::user()->name ?? 'Admin User' }}</p>
                        <p class="text-xs truncate" style="color: rgba(255,255,255,0.5);">{{ Auth::user()->email ?? '' }}</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn flex w-full items-center gap-3 px-4 py-2.5 text-sm font-semibold">
                        <svg class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                        </svg>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main content -->
        <div class="flex-1 flex flex-col md:h-screen md:overflow-y-auto">
            <!-- Top Navbar -->
            <header class="main-header flex h-16 items-center justify-between px-6">
                <div class="flex items-center gap-4">
                    <!-- Hamburger (mobile only) -->
                    <button type="button" class="md:hidden" style="color: #7A6B72;" onclick="toggleMobileSidebar()">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                    <h2 class="text-xl font-bold leading-7" style="color: #3A2E36;">@yield('title')</h2>
                </div>

                <div class="flex items-center gap-4">
                    <div class="text-right hidden sm:block">
                        <span class="text-sm font-semibold" style="color: #3A2E36;">{{ Auth::user()->name ?? 'Admin User' }}</span>
                        <p class="text-xs" style="color: #7A6B72;">Administrator</p>
                    </div>
                    <div class="h-9 w-9 rounded-full flex items-center justify-center font-bold text-sm shadow-sm" style="background: #5C2A3E; color: #fff;">
                        {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                    </div>
                </div>
            </header>

            <!-- Main wrapper -->
            <main class="flex-1 p-6 md:p-8" style="background: #FBF3F5;">
                <!-- Flash messages -->
                @if (session('success'))
                    <div id="flash-success" class="flash-success mb-6 flex items-center gap-3 rounded-xl p-4 transition duration-300">
                        <svg class="h-5 w-5 flex-shrink-0" style="color: #A9C9A4;" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <p class="text-sm font-semibold">{{ session('success') }}</p>
                    </div>
                @endif

                @if (session('error'))
                    <div id="flash-error" class="flash-error mb-6 flex items-center gap-3 rounded-xl p-4 transition duration-300">
                        <svg class="h-5 w-5 flex-shrink-0" style="color: #F4A0A0;" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                        </svg>
                        <p class="text-sm font-semibold">{{ session('error') }}</p>
                    </div>
                @endif

                <!-- Content -->
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        function toggleMobileSidebar() {
            const sidebar = document.getElementById('sidebar');
            const backdrop = document.getElementById('mobile-sidebar-backdrop');

            if (sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.remove('-translate-x-full');
                backdrop.classList.remove('hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
                backdrop.classList.add('hidden');
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const successAlert = document.getElementById('flash-success');
            const errorAlert = document.getElementById('flash-error');

            if (successAlert) {
                setTimeout(() => {
                    successAlert.style.opacity = '0';
                    setTimeout(() => successAlert.remove(), 300);
                }, 3500);
            }

            if (errorAlert) {
                setTimeout(() => {
                    errorAlert.style.opacity = '0';
                    setTimeout(() => errorAlert.remove(), 300);
                }, 3500);
            }
        });
    </script>
    @yield('scripts')
</body>
</html>
