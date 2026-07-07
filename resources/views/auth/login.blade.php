<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Al-Noor School Fee Management System — Sign in to manage student fee records.">

    <title>Sign In — Al-Noor School Fee Management</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }

        .bg-canvas {
            background: linear-gradient(135deg, #5C2A3E 0%, #C98A9E 50%, #D9A99A 100%);
        }

        .card-shadow {
            box-shadow: 0 20px 60px rgba(92, 42, 62, 0.25), 0 4px 16px rgba(92, 42, 62, 0.12);
        }

        .btn-primary {
            background: linear-gradient(135deg, #5C2A3E, #4A2232);
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #4A2232, #3A1A28);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(92, 42, 62, 0.35);
        }

        .input-field {
            border: 1.5px solid #D9A99A;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .input-field:focus {
            border-color: #5C2A3E;
            box-shadow: 0 0 0 3px rgba(92, 42, 62, 0.12);
            outline: none;
        }

        .logo-pulse {
            animation: pulse-ring 2.5s ease-in-out infinite;
        }

        @keyframes pulse-ring {
            0%, 100% { box-shadow: 0 0 0 0 rgba(201, 138, 158, 0.4); }
            50%       { box-shadow: 0 0 0 12px rgba(201, 138, 158, 0); }
        }
    </style>
</head>
<body class="h-full bg-canvas flex flex-col items-center justify-center min-h-screen py-12 px-4">

    <div class="w-full max-w-md">
        <!-- Login Card -->
        <div class="bg-white rounded-2xl card-shadow overflow-hidden">

            <!-- Card header strip -->
            <div class="h-2 w-full" style="background: linear-gradient(90deg, #5C2A3E, #C98A9E, #A9C9A4);"></div>

            <div class="px-8 py-8">
                <!-- Logo Icon -->
                <div class="flex justify-center mb-5">
                    <div class="logo-pulse h-16 w-16 rounded-2xl flex items-center justify-center" style="background: linear-gradient(135deg, #5C2A3E, #4A2232);">
                        <svg class="h-9 w-9 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.57 50.57 0 0 0-2.658-.813A5.905 5.905 0 0 1 1.091 7.497 4.907 4.907 0 0 1 6.18 4.25a5.002 5.002 0 0 1 6.03 1.07 5.002 5.002 0 0 1 6.03-1.07 4.907 4.907 0 0 1 5.087 3.247 5.905 5.905 0 0 1-3.413 2.657 50.567 50.567 0 0 0-2.658.813M4.26 10.147a48.674 48.674 0 0 0 15.48 0" />
                        </svg>
                    </div>
                </div>

                <!-- Title -->
                <h1 class="text-2xl font-extrabold text-center tracking-tight mb-1" style="color: #3A2E36;">Al-Noor School</h1>
                <p class="text-sm text-center font-medium mb-6" style="color: #7A6B72;">Fee Management System</p>

                <!-- Error Box -->
                @if ($errors->any())
                    <div class="mb-5 p-4 rounded-xl border text-sm font-medium" style="background: #FFF0F0; border-color: #F4A0A0; color: #8B3A3A;">
                        <div class="flex items-start gap-2.5">
                            <svg class="h-4 w-4 flex-shrink-0 mt-0.5" style="color: #F4A0A0;" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                            </svg>
                            <ul class="list-disc list-inside space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <!-- Form -->
                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <!-- Email field -->
                    <div>
                        <label for="email" class="block text-sm font-semibold mb-1.5" style="color: #3A2E36;">Email Address</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                               placeholder="your@email.com"
                               class="input-field block w-full rounded-xl py-2.5 px-3.5 text-sm"
                               style="background: #FBF3F5; color: #3A2E36;">
                    </div>

                    <!-- Password field -->
                    <div>
                        <label for="password" class="block text-sm font-semibold mb-1.5" style="color: #3A2E36;">Password</label>
                        <div class="relative">
                            <input id="password" type="password" name="password" required
                                   placeholder="••••••••"
                                   class="input-field block w-full rounded-xl py-2.5 pl-3.5 pr-10 text-sm"
                                   style="background: #FBF3F5; color: #3A2E36;">
                            <button type="button" onclick="togglePasswordVisibility()"
                                    class="absolute inset-y-0 right-0 pr-3.5 flex items-center focus:outline-none"
                                    style="color: #7A6B72;">
                                <svg id="eye-icon" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                <svg id="eye-slash-icon" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.815 7.815 3 3m-3-3-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Remember me -->
                    <div class="flex items-center">
                        <input id="remember_me" type="checkbox" name="remember"
                               class="h-4 w-4 rounded border-gray-300 focus:ring-2 cursor-pointer"
                               style="accent-color: #5C2A3E;">
                        <label for="remember_me" class="ml-2.5 text-sm font-semibold select-none cursor-pointer" style="color: #7A6B72;">
                            Remember Me
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                            class="btn-primary w-full flex justify-center py-2.5 px-4 rounded-xl text-sm font-bold text-white shadow-sm">
                        Sign In
                    </button>

                    <!-- Register link -->
                    <p class="text-center text-sm" style="color: #7A6B72;">
                        New student?
                        <a href="{{ route('register') }}" class="font-semibold hover:underline" style="color: #5C2A3E;">Create an account</a>
                    </p>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <p class="mt-8 text-center text-xs font-semibold uppercase tracking-widest" style="color: rgba(255,255,255,0.6);">
        Al-Noor School Fee Management System &copy; {{ date('Y') }}
    </p>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            const eyeSlashIcon = document.getElementById('eye-slash-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.add('hidden');
                eyeSlashIcon.classList.remove('hidden');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('hidden');
                eyeSlashIcon.classList.add('hidden');
            }
        }
    </script>
</body>
</html>
