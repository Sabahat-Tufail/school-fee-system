<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>No Record Found — Al-Noor School Fee Management</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; background: #FBF3F5; color: #3A2E36; }
        .card-shadow {
            box-shadow: 0 10px 30px rgba(92, 64, 86, 0.08), 0 1px 3px rgba(92, 64, 86, 0.05);
        }
        .btn-primary {
            background: #7D5A75;
            transition: all 0.2s ease;
        }
        .btn-primary:hover {
            background: #5C4056;
            transform: translateY(-1px);
        }
    </style>
</head>
<body class="h-full flex flex-col items-center justify-center min-h-screen py-12 px-4">

    <div class="w-full max-w-md">
        <div class="bg-white rounded-2xl p-8 card-shadow border border-rose-100 text-center">
            
            <!-- Warning/Alert Icon -->
            <div class="flex justify-center mb-6">
                <div class="h-16 w-16 rounded-full flex items-center justify-center" style="background: #FFF0F0; color: #F4A0A0;">
                    <svg class="h-10 w-10 animate-bounce" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                    </svg>
                </div>
            </div>

            <!-- Title -->
            <h1 class="text-xl font-bold tracking-tight mb-2" style="color: #3A2E36;">No Student Record Linked</h1>
            
            <!-- Message -->
            <p class="text-sm leading-relaxed mb-6" style="color: #7A6B72;">
                Your account is not yet linked to a student record. Please contact your school admin and provide your Roll Number.
            </p>

            <!-- Roll Number Tag -->
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-xl mb-8 font-semibold text-sm" style="background: #FDF0F5; color: #7D5A75; border: 1px solid #F2C6D8;">
                <span>Your Roll Number:</span>
                <span class="font-extrabold">{{ $user->roll_number ?? 'Not Specified' }}</span>
            </div>

            <!-- Action / Logout -->
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit" class="btn-primary w-full flex justify-center py-2.5 px-4 rounded-xl text-sm font-bold text-white shadow-sm">
                    Logout &amp; Exit
                </button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <p class="mt-8 text-center text-xs font-semibold uppercase tracking-widest" style="color: #7A6B72;">
        Al-Noor School Fee Management System &copy; {{ date('Y') }}
    </p>

</body>
</html>
