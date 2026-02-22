<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                {{ __('Eksplorasi Beasiswa') }}
            </h2>
            <p class="text-sm text-gray-500 mt-1 md:mt-0">Temukan peluang masa depan Anda hari ini.</p>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-10 p-8 bg-gradient-to-r from-indigo-600 to-blue-500 rounded-3xl shadow-xl text-white">
                <h1 class="text-3xl font-extrabold mb-2">Halo, {{ Auth::user()->username }}! 👋</h1>
                <p class="text-indigo-100 opacity-90">Ada {{ $beasiswas->count() }} program beasiswa yang sedang membuka pendaftaran untuk Anda.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($beasiswas as $b)
                    <div class="group bg-white rounded-3xl shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 border border-gray-100 overflow-hidden flex flex-col">
                        <div class="h-2 bg-gradient-to-r from-indigo-500 to-blue-400"></div>
                        
                        <div class="p-8 flex-grow">
                            <div class="flex justify-between items-start mb-6">
                                <div class="p-3 bg-indigo-50 rounded-2xl text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-300">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                                    </svg>
                                </div>
                                <span class="flex items-center gap-1.5 px-3 py-1 bg-emerald-50 text-emerald-700 text-[11px] font-bold uppercase rounded-full tracking-wider animate-pulse">
                                    <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                                    Terbuka
                                </span>
                            </div>

                            <h3 class="text-xl font-bold text-gray-800 group-hover:text-indigo-600 transition-colors mb-3">
                                {{ $b->nama }}
                            </h3>
                            <p class="text-sm text-gray-500 leading-relaxed mb-6">
                                Raih bantuan pendidikan untuk periode program <strong>{{ $b->periode }}</strong>. Persiapkan dokumen terbaik Anda.
                            </p>

                            <div class="grid grid-cols-2 gap-4 py-4 border-t border-gray-50">
                                <div>
                                    <span class="block text-[10px] uppercase tracking-wider text-gray-400 font-bold mb-1">Kuota</span>
                                    <span class="text-sm font-semibold text-gray-700">{{ $b->kuota }} Penerima</span>
                                </div>
                                <div>
                                    <span class="block text-[10px] uppercase tracking-wider text-gray-400 font-bold mb-1">Periode</span>
                                    <span class="text-sm font-semibold text-gray-700">{{ $b->periode }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="px-8 pb-8">
                            <a href="{{ route('mahasiswa.beasiswa.detail', $b->id) }}" 
                            class="flex items-center justify-center w-full px-6 py-3 bg-gray-900 text-white text-sm font-bold rounded-xl hover:bg-indigo-600 hover:shadow-lg hover:shadow-indigo-200 transition-all duration-300">
                                Lihat Detail & Daftar
                                <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full flex flex-col items-center justify-center p-20 bg-white rounded-3xl shadow-sm border border-dashed border-gray-300">
                        <div class="p-4 bg-gray-50 rounded-full mb-4">
                            <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                        </div>
                        <p class="text-gray-500 font-medium">Saat ini belum ada beasiswa yang tersedia untuk didaftar.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>