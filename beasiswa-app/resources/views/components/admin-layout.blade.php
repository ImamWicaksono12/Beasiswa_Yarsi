<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sibeasiswa - Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 antialiased font-sans">
    <div class="min-h-screen flex">
        <aside class="w-72 bg-white border-r border-gray-100 flex flex-col sticky top-0 h-screen">
            <div class="p-8">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center text-white shadow-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.168.477 4.492 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.492 1.253"></path></svg>
                    </div>
                    <span class="font-black text-xl italic tracking-tighter text-gray-800 uppercase">Sibea<span class="text-indigo-600 font-bold not-italic">Admin</span></span>
                </div>
            </div>

            <nav class="flex-1 px-6 space-y-2 mt-4">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-4 text-sm font-black italic rounded-2xl {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-100' : 'text-gray-400 hover:bg-gray-50' }}">
                    Dashboard
                </a>
                <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-4 text-sm font-black italic rounded-2xl {{ request()->routeIs('admin.users.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-100' : 'text-gray-400 hover:bg-gray-50' }}">
                    Manajemen Akun
                </a>
            </nav>

            <div class="p-6 border-t border-gray-50">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center px-4 py-4 text-sm font-black italic text-rose-500 hover:bg-rose-50 rounded-2xl transition-all uppercase tracking-widest">
                        Keluar
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1">
            <header class="h-24 bg-white border-b border-gray-50 flex items-center justify-between px-10">
                <h2 class="font-black text-gray-800 italic uppercase tracking-widest text-sm">Panel Kendali Utama</h2>
                <div class="flex items-center gap-4">
                    <div class="text-right">
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Login Sebagai</p>
                        <p class="text-sm font-bold text-gray-800">{{ Auth::user()->name }}</p>
                    </div>
                </div>
            </header>

            <div class="p-10">
                {{ $slot }}
            </div>
        </main>
    </div>
</body>
</html>