<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Yarsi Beasiswa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 antialiased">
    <div class="flex min-h-screen">
        
        <aside class="w-72 bg-white border-r border-gray-100 flex flex-col fixed h-full z-50">
            <div class="p-8 mb-4">
                <h1 class="text-2xl font-black italic tracking-tighter">
                    YARSI<span class="text-indigo-600">.</span>
                </h1>
                <p class="text-[9px] font-black text-gray-300 uppercase tracking-[0.5em]">Scholarship System</p>
            </div>

            <nav class="flex-1 px-6 space-y-2 overflow-y-auto custom-scrollbar">
                <a href="{{ route('admin.dashboard') }}" 
                class="flex items-center gap-4 px-6 py-4 {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600 text-white shadow-xl shadow-indigo-200' : 'text-gray-400 hover:text-indigo-600' }} rounded-2xl font-black text-xs uppercase italic tracking-widest transition-all transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Dashboard
                </a>

                @stack('sidebar-extra')

                <div class="pt-10 pb-4 px-6">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.4em]">Internal Menu</p>
                </div>

                <a href="{{ route('admin.beasiswa.index') }}" 
                class="flex items-center gap-4 px-6 py-4 {{ request()->routeIs('admin.beasiswa.*') ? 'text-indigo-600 bg-indigo-50/50' : 'text-gray-400' }} hover:text-indigo-600 rounded-2xl font-bold text-xs uppercase tracking-widest transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    Daftar Program
                </a>

                <a href="{{ route('admin.monev.index') }}" 
                class="flex items-center gap-4 px-6 py-4 {{ request()->routeIs('admin.monev.*') ? 'text-indigo-600 bg-indigo-50/50' : 'text-gray-400' }} hover:text-indigo-600 rounded-2xl font-bold text-xs uppercase tracking-widest transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    Monitoring
                </a>
            </nav>

            <div class="p-6 border-t border-gray-50">
                <div class="bg-gray-50 rounded-2xl p-4 flex items-center gap-3">
                    <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center text-white font-black text-xs uppercase italic">
                        AD
                    </div>
                    <div class="flex-1 overflow-hidden">
                        <p class="text-xs font-black text-gray-900 truncate uppercase tracking-tighter italic">Administrator</p>
                        <p class="text-[9px] text-gray-400 truncate uppercase font-bold tracking-widest">Master Panel</p>
                    </div>
                </div>
            </div>
        </aside>

        <main class="flex-1 ml-72 p-12">
            <header class="flex justify-between items-center mb-12">
                <div class="flex items-center gap-4 bg-white px-6 py-3 rounded-2xl border border-gray-100 shadow-sm">
                    <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></div>
                    <span class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Sistem Aktif</span>
                </div>
                
                <div class="flex items-center gap-6">
                    <button class="relative p-2 text-gray-400 hover:text-indigo-600 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                        <span class="absolute top-0 right-0 w-2 h-2 bg-rose-500 rounded-full border-2 border-white"></span>
                    </button>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-xs font-black text-rose-500 uppercase tracking-widest hover:text-rose-700 transition-colors italic">
                            Logout ➔
                        </button>
                    </form>
                </div>
            </header>

            <div class="relative">
                {{ $slot }}
            </div>
        </main>
    </div>

    @stack('scripts')
</body>
</html>