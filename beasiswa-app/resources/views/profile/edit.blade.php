<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="font-extrabold text-2xl text-gray-800 leading-tight">
                    {{ __('Pengaturan Profil') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">Kelola informasi akun dan keamanan Anda di satu tempat.</p>
            </div>
            <div class="hidden md:block">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center text-sm text-gray-500">Dashboard</li>
                        <li><svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"></path></svg></li>
                        <li class="text-sm font-bold text-indigo-600">Profil</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50/50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-[2rem] shadow-xl shadow-gray-200/50 border border-gray-100 p-8 sticky top-24">
                        <div class="flex flex-col items-center">
                            <div class="relative">
                                <div class="h-24 w-24 rounded-3xl bg-gradient-to-tr from-indigo-600 to-blue-500 flex items-center justify-center text-white text-3xl font-black shadow-2xl rotate-3">
                                    {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
                                </div>
                                <div class="absolute -bottom-2 -right-2 h-8 w-8 bg-emerald-500 border-4 border-white rounded-full flex items-center justify-center shadow-sm">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                            </div>
                            <h3 class="mt-6 text-xl font-bold text-gray-900">{{ Auth::user()->username }}</h3>
                            <p class="text-xs font-bold text-indigo-500 uppercase tracking-widest mt-1">Mahasiswa Aktif</p>
                            
                            <div class="w-full mt-8 space-y-3">
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-2xl border border-gray-100 text-sm">
                                    <span class="text-gray-500 font-medium">Status Akun</span>
                                    <span class="px-2 py-0.5 bg-emerald-100 text-emerald-700 rounded-lg text-[10px] font-black uppercase">Verified</span>
                                </div>
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-2xl border border-gray-100 text-sm">
                                    <span class="text-gray-500 font-medium">Terdaftar Sejak</span>
                                    <span class="font-bold text-gray-800">{{ Auth::user()->created_at->format('M Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-2 space-y-8">
                    
                    <div class="bg-white rounded-[2rem] shadow-xl shadow-gray-200/50 border border-gray-100 overflow-hidden">
                        <div class="p-8 border-b border-gray-50 flex items-center gap-4">
                            <div class="p-3 bg-indigo-50 rounded-xl text-indigo-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-lg text-gray-800 italic">Data Pribadi</h3>
                                <p class="text-xs text-gray-400">Update nama dan alamat email akun Anda.</p>
                            </div>
                        </div>
                        <div class="p-8">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <div class="bg-white rounded-[2rem] shadow-xl shadow-gray-200/50 border border-gray-100 overflow-hidden">
                        <div class="p-8 border-b border-gray-50 flex items-center gap-4">
                            <div class="p-3 bg-rose-50 rounded-xl text-rose-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-11V7a4 4 0 11-8 0v4h8z"></path></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-lg text-gray-800 italic">Keamanan</h3>
                                <p class="text-xs text-gray-400">Pastikan akun Anda menggunakan password yang kuat.</p>
                            </div>
                        </div>
                        <div class="p-8">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    <div class="bg-rose-50 rounded-[2rem] border border-rose-100 overflow-hidden">
                        <div class="p-8">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>