<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Al-Noor School — Student registration for Fee Management System.">

    <title>Register — Al-Noor School Fee Management</title>

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

        .input-error {
            border-color: #F4A0A0 !important;
        }
    </style>
</head>
<body class="h-full bg-canvas flex flex-col items-center justify-center min-h-screen py-12 px-4">

    <div class="w-full max-w-md">
        <!-- Register Card -->
        <div class="bg-white rounded-2xl card-shadow overflow-hidden">

            <!-- Card header strip -->
            <div class="h-2 w-full" style="background: linear-gradient(90deg, #5C2A3E, #C98A9E, #A9C9A4);"></div>

            <div class="px-8 py-8">
                <!-- Logo Icon -->
                <div class="flex justify-center mb-4">
                    <div class="h-14 w-14 rounded-2xl flex items-center justify-center" style="background: linear-gradient(135deg, #5C2A3E, #4A2232);">
                        <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.57 50.57 0 0 0-2.658-.813A5.905 5.905 0 0 1 1.091 7.497 4.907 4.907 0 0 1 6.18 4.25a5.002 5.002 0 0 1 6.03 1.07 5.002 5.002 0 0 1 6.03-1.07 4.907 4.907 0 0 1 5.087 3.247 5.905 5.905 0 0 1-3.413 2.657 50.567 50.567 0 0 0-2.658.813M4.26 10.147a48.674 48.674 0 0 0 15.48 0" />
                        </svg>
                    </div>
                </div>

                <!-- Title -->
                <h1 class="text-xl font-extrabold text-center tracking-tight mb-1" style="color: #3A2E36;">Create Student Account</h1>
                <p class="text-xs text-center font-medium mb-6" style="color: #7A6B72;">Al-Noor School Fee Management System</p>

                <!-- Error Box -->
                @if ($errors->any())
                    <div class="mb-5 p-4 rounded-xl border text-sm font-medium" style="background: #FFF0F0; border-color: #F4A0A0; color: #8B3A3A;">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Form -->
                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-semibold mb-1.5" style="color: #3A2E36;">Full Name</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                               placeholder="e.g. Sara Ahmed"
                               class="input-field block w-full rounded-xl py-2.5 px-3.5 text-sm {{ $errors->has('name') ? 'input-error' : '' }}"
                               style="background: #FBF3F5; color: #3A2E36;">
                        @error('name')
                            <p class="mt-1 text-xs font-semibold" style="color: #F4A0A0;">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Roll Number -->
                    <div>
                        <label for="roll_number" class="block text-sm font-semibold mb-1.5" style="color: #3A2E36;">Roll Number</label>
                        <input id="roll_number" type="text" name="roll_number"
                               placeholder="e.g. 001"
                               value="{{ old('roll_number') }}"
                               class="input-field block w-full rounded-xl py-2.5 px-3.5 text-sm {{ $errors->has('roll_number') ? 'input-error' : '' }}"
                               style="background: #FBF3F5; color: #3A2E36;">
                        <p class="mt-1 text-xs" style="color: #7A6B72;">Enter your school roll number to link your account to your fee record.</p>
                        @error('roll_number')
                            <p class="mt-1 text-xs font-semibold" style="color: #F4A0A0;">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-semibold mb-1.5" style="color: #3A2E36;">Email Address</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                               placeholder="your@email.com"
                               class="input-field block w-full rounded-xl py-2.5 px-3.5 text-sm {{ $errors->has('email') ? 'input-error' : '' }}"
                               style="background: #FBF3F5; color: #3A2E36;">
                        @error('email')
                            <p class="mt-1 text-xs font-semibold" style="color: #F4A0A0;">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-semibold mb-1.5" style="color: #3A2E36;">Password</label>
                        <input id="password" type="password" name="password" required
                               placeholder="••••••••"
                               class="input-field block w-full rounded-xl py-2.5 px-3.5 text-sm {{ $errors->has('password') ? 'input-error' : '' }}"
                               style="background: #FBF3F5; color: #3A2E36;">
                        @error('password')
                            <p class="mt-1 text-xs font-semibold" style="color: #F4A0A0;">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold mb-1.5" style="color: #3A2E36;">Confirm Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                               placeholder="••••••••"
                               class="input-field block w-full rounded-xl py-2.5 px-3.5 text-sm"
                               style="background: #FBF3F5; color: #3A2E36;">
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="btn-primary w-full flex justify-center py-2.5 px-4 rounded-xl text-sm font-bold text-white shadow-sm mt-2">
                        Create Account
                    </button>

                    <!-- Already registered -->
                    <p class="text-center text-sm" style="color: #7A6B72;">
                        Already have an account?
                        <a href="{{ route('login') }}" class="font-semibold hover:underline" style="color: #5C2A3E;">Sign In</a>
                    </p>
                </form>

                <!-- Note -->
                <div class="mt-5 p-3 rounded-xl text-xs font-medium text-center" style="background: #FBF3F5; color: #7A6B72; border: 1px solid #D9A99A;">
                    <strong style="color: #5C2A3E;">Note:</strong> This registration is for students only. Admin accounts are managed separately.
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <p class="mt-8 text-center text-xs font-semibold uppercase tracking-widest" style="color: rgba(255,255,255,0.6);">
        Al-Noor School Fee Management System &copy; {{ date('Y') }}
    </p>
</body>
</html>
