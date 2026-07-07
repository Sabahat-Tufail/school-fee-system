<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Al-Noor School — Student Fee Dashboard">

    <title>My Dashboard — Al-Noor School Fee Management</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; background: #FBF3F5; color: #3A2E36; }

        #sidebar { background: #5C2A3E; }
        .sidebar-brand { border-bottom: 1px solid rgba(255,255,255,0.1); }
        .sidebar-logo { background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.2); }

        .nav-link {
            color: rgba(255,255,255,0.75);
            transition: all 0.18s ease;
            border-radius: 0.75rem;
        }
        .nav-link:hover { background: rgba(255,255,255,0.1); color: #fff; }
        .nav-link.active { background: #C98A9E; color: #fff; box-shadow: 0 4px 14px rgba(92, 42, 62, 0.4); }

        .main-header { background: #fff; border-bottom: 1px solid #F2D5E0; }

        .stat-card { background: #fff; border-radius: 1rem; border: 1px solid; box-shadow: 0 2px 8px rgba(92,64,86,0.07); }

        .info-card { background: #fff; border-radius: 1rem; border: 1px solid #F2D5E0; box-shadow: 0 2px 8px rgba(92,64,86,0.07); }

        .sidebar-user-card { background: rgba(255,255,255,0.08); border-radius: 0.75rem; }
        .sidebar-avatar { background: #C98A9E; color: #5C2A3E; }
        .logout-btn { color: #D9A99A; transition: all 0.18s ease; border-radius: 0.75rem; }
        .logout-btn:hover { background: rgba(244, 160, 160, 0.2); color: #F4A0A0; }

        @media print {
            #sidebar, #mobile-sidebar-backdrop, .no-print { display: none !important; }
        }
    </style>
</head>
<body class="h-full" style="background: #FBF3F5;">
<div class="min-h-full flex flex-col md:flex-row">

    <!-- Mobile backdrop -->
    <div id="mobile-sidebar-backdrop" class="fixed inset-0 z-40 hidden md:hidden" style="background: rgba(58,46,54,0.5);" onclick="toggleSidebar()"></div>

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

        <!-- Nav -->
        <nav class="flex-1 space-y-1 px-4 py-6 overflow-y-auto">
            <a href="{{ route('student.dashboard') }}" class="nav-link active flex items-center gap-3 px-4 py-3 text-sm font-semibold">
                <span class="text-lg">🏠</span>
                <span>My Dashboard</span>
            </a>
        </nav>

        <!-- Bottom -->
        <div class="p-4" style="border-top: 1px solid rgba(255,255,255,0.1);">
            <div class="sidebar-user-card flex items-center gap-3 px-3 py-3 mb-3 overflow-hidden">
                <div class="sidebar-avatar h-9 w-9 flex-shrink-0 rounded-full flex items-center justify-center font-bold text-sm">
                    {{ substr($user->name ?? 'S', 0, 1) }}
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-semibold text-white truncate">{{ $user->name ?? 'Student' }}</p>
                    <p class="text-xs truncate" style="color: rgba(255,255,255,0.5);">{{ $user->email ?? '' }}</p>
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

    <!-- Main Content -->
    <div class="flex-1 flex flex-col md:h-screen md:overflow-y-auto">
        <!-- Top Navbar -->
        <header class="main-header flex h-16 items-center justify-between px-6">
            <div class="flex items-center gap-4">
                <button type="button" class="md:hidden" style="color: #7A6B72;" onclick="toggleSidebar()">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
                <h2 class="text-xl font-bold" style="color: #3A2E36;">Welcome, {{ $user->name }}!</h2>
            </div>
            <div class="flex items-center gap-3">
                <div class="text-right hidden sm:block">
                    <span class="text-sm font-semibold" style="color: #3A2E36;">{{ $user->name }}</span>
                    <p class="text-xs" style="color: #7A6B72;">Student</p>
                </div>
                <div class="h-9 w-9 rounded-full flex items-center justify-center font-bold text-sm" style="background: #C98A9E; color: #5C2A3E;">
                    {{ substr($user->name ?? 'S', 0, 1) }}
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 p-6 md:p-8 space-y-8" style="background: #FBF3F5;">

            <!-- Section 1: Student Info Card -->
            <div class="info-card p-6">
                <div class="flex items-center gap-3 mb-5">
                    <div class="h-10 w-10 rounded-xl flex items-center justify-center text-xl" style="background: #F9EDF5;">🎓</div>
                    <div>
                        <h3 class="text-base font-bold" style="color: #3A2E36;">Student Information</h3>
                        <p class="text-xs" style="color: #7A6B72;">Your personal & academic details</p>
                    </div>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
                    <div class="p-3 rounded-xl" style="background: #FBF3F5;">
                        <p class="text-xs font-semibold uppercase tracking-wide mb-1" style="color: #7A6B72;">Full Name</p>
                        <p class="font-bold text-sm" style="color: #3A2E36;">{{ $student->first_name }} {{ $student->last_name }}</p>
                    </div>
                    <div class="p-3 rounded-xl" style="background: #FBF3F5;">
                        <p class="text-xs font-semibold uppercase tracking-wide mb-1" style="color: #7A6B72;">Roll Number</p>
                        <p class="font-bold text-sm" style="color: #5C2A3E;">{{ $student->roll_number ?? '—' }}</p>
                    </div>
                    <div class="p-3 rounded-xl" style="background: #FBF3F5;">
                        <p class="text-xs font-semibold uppercase tracking-wide mb-1" style="color: #7A6B72;">Class</p>
                        <p class="font-bold text-sm" style="color: #3A2E36;">{{ $student->feeStructure->class_name ?? '—' }}</p>
                    </div>
                    <div class="p-3 rounded-xl" style="background: #FBF3F5;">
                        <p class="text-xs font-semibold uppercase tracking-wide mb-1" style="color: #7A6B72;">Section</p>
                        <p class="font-bold text-sm" style="color: #3A2E36;">{{ $student->feeStructure->section ?? '—' }}</p>
                    </div>
                    <div class="p-3 rounded-xl" style="background: #FBF3F5;">
                        <p class="text-xs font-semibold uppercase tracking-wide mb-1" style="color: #7A6B72;">Admission Date</p>
                        <p class="font-bold text-sm" style="color: #3A2E36;">{{ $student->admission_date ? date('M d, Y', strtotime($student->admission_date)) : '—' }}</p>
                    </div>
                </div>
            </div>

            <!-- Section 2: Fee Summary Cards -->
            @php
                $feeDue       = $account ? ($account->total_fee_due ?? 0) : 0;
                $totalPaid    = $transactions->where('transaction_type', 'payment')->sum('amount');
                $totalFines   = $transactions->where('transaction_type', 'fine')->sum('amount');
                $totalConc    = $transactions->where('transaction_type', 'concession')->sum('amount');
                $outstanding  = $account ? ($account->outstanding_balance ?? max(0, $feeDue - $totalPaid + $totalFines - $totalConc)) : 0;
            @endphp
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                <!-- Total Fee Due -->
                <div class="stat-card p-5" style="border-color: #C98A9E;">
                    <p class="text-xs font-semibold uppercase tracking-wide mb-2" style="color: #5C2A3E;">Total Fee Due</p>
                    <p class="text-2xl font-black" style="color: #3A2E36;">Rs. {{ number_format($account->total_fee_due ?? 0, 2) }}</p>
                    <div class="h-1 w-10 rounded-full mt-3" style="background: #C98A9E;"></div>
                </div>
                <!-- Total Paid -->
                <div class="stat-card p-5" style="border-color: #A9C9A4;">
                    <p class="text-xs font-semibold uppercase tracking-wide mb-2" style="color: #4A7A45;">Total Paid</p>
                    <p class="text-2xl font-black" style="color: #3A2E36;">Rs. {{ number_format($totalPaid, 2) }}</p>
                    <div class="h-1 w-10 rounded-full mt-3" style="background: #A9C9A4;"></div>
                </div>
                <!-- Outstanding Balance -->
                <div class="stat-card p-5" style="border-color: #F4A0A0;">
                    <p class="text-xs font-semibold uppercase tracking-wide mb-2" style="color: #8B3A3A;">Outstanding Balance</p>
                    <p class="text-2xl font-black" style="color: #3A2E36;">Rs. {{ number_format($account->outstanding_balance ?? 0, 2) }}</p>
                    <div class="h-1 w-10 rounded-full mt-3" style="background: #F4A0A0;"></div>
                </div>
                <!-- Concessions -->
                <div class="stat-card p-5" style="border-color: #D9A99A;">
                    <p class="text-xs font-semibold uppercase tracking-wide mb-2" style="color: #5C2A3E;">Concessions Applied</p>
                    <p class="text-2xl font-black" style="color: #3A2E36;">Rs. {{ number_format($totalConc, 2) }}</p>
                    <div class="h-1 w-10 rounded-full mt-3" style="background: #D9A99A;"></div>
                </div>
            </div>

            <!-- Section 3: Transactions Table -->
            <div id="my-transactions" class="info-card overflow-hidden">
                <div class="flex items-center gap-3 px-6 py-5" style="border-bottom: 1px solid #F2D5E0;">
                    <div class="h-8 w-8 rounded-lg flex items-center justify-center text-base" style="background: #F9EDF5;">🧾</div>
                    <h3 class="text-base font-bold" style="color: #3A2E36;">My Transactions</h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="text-xs font-semibold uppercase tracking-wider" style="background: #FBF3F5; color: #7A6B72; border-bottom: 1px solid #F2D5E0;">
                                <th class="px-6 py-4">Date</th>
                                <th class="px-6 py-4">Type</th>
                                <th class="px-6 py-4">Amount</th>
                                <th class="px-6 py-4">Category</th>
                                <th class="px-6 py-4 text-right">Receipt</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            @forelse($transactions as $transaction)
                                <tr class="border-b transition-colors hover:bg-rose-50/30" style="border-color: #F9EEF2;">
                                    <td class="px-6 py-4" style="color: #7A6B72;">
                                        {{ date('M d, Y', strtotime($transaction->transaction_date)) }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($transaction->transaction_type === 'payment')
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold" style="background: #EEF7EE; color: #4A7A45; border: 1px solid #A9C9A4;">Payment</span>
                                        @elseif($transaction->transaction_type === 'fine')
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold" style="background: #FFF0F0; color: #8B3A3A; border: 1px solid #F4A0A0;">Fine</span>
                                        @elseif($transaction->transaction_type === 'concession')
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold" style="background: #FDF0F5; color: #7D3B5A; border: 1px solid #F2C6D8;">Concession</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 font-bold" style="color: #3A2E36;">
                                        Rs. {{ number_format($transaction->amount, 2) }}
                                    </td>
                                    <td class="px-6 py-4" style="color: #7A6B72;">
                                        {{ $transaction->category }}
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        @if($transaction->paymentReceipt)
                                            <a href="{{ route('student.receipt', $transaction->paymentReceipt->id) }}"
                                               class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold transition-colors"
                                               style="color: #5C2A3E;"
                                               onmouseover="this.style.background='#FBF3F5';"
                                               onmouseout="this.style.background='transparent';">
                                                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                                </svg>
                                                View Receipt
                                            </a>
                                        @else
                                            <span class="text-xs" style="color: #7A6B72;">No Receipt</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center font-medium" style="color: #7A6B72;">
                                        No transactions recorded yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>
</div>

<script>
    function toggleSidebar() {
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
</script>
</body>
</html>
