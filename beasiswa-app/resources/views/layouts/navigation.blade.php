<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 sticky top-0 z-50 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <x-application-logo class="block h-9 w-auto fill-current text-indigo-600" />
                        <span class="font-bold text-xl tracking-tight text-gray-800">Sibeasiswa</span>
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-sm font-medium">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('mahasiswa.riwayat')" :active="request()->routeIs('mahasiswa.riwayat')" class="text-sm font-medium">
                        {{ __('Riwayat Pendaftaran') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-4">
                <button class="relative p-2 text-gray-400 hover:text-indigo-600 transition-colors focus:outline-none">
                    <span class="sr-only">Notifikasi</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7c0-2.485-2.099-4.5-4.688-4.5-.138 0-.272.006-.405.018a4.502 4.502 0 00-8.127 1.17C4.447 5.764 4 6.73 4 7.777v.973c0 2.016-.453 3.926-1.27 5.634a23.27 23.27 0 005.454 1.31m5.945 0a3.374 3.374 0 01-6.748 0m6.748 0a3.374 3.374 0 00-6.748 0" />
                    </svg>
                    <span class="absolute top-1 right-1 flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span>
                    </span>
                </button>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center gap-3 px-3 py-1 border border-transparent text-sm font-medium rounded-full text-gray-500 bg-gray-50 hover:bg-white hover:shadow-sm focus:outline-none transition ease-in-out duration-150 border-gray-200">
                            <div class="text-right hidden md:block">
                                <div class="text-gray-800 font-semibold leading-none">{{ Auth::user()->username }}</div>
                                <div class="text-[10px] text-gray-400 uppercase tracking-widest mt-1">Mahasiswa</div>
                            </div>
                            <div class="h-8 w-8 rounded-full bg-indigo-600 flex items-center justify-center text-white font-bold shadow-md">
                                {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-2 text-xs text-gray-400">Pengaturan Akun</div>
                        <x-dropdown-link :href="route('profile.edit')"> {{ __('Profil Saya') }} </x-dropdown-link>
                        <hr class="border-gray-100">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-red-600">
                                {{ __('Keluar') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>