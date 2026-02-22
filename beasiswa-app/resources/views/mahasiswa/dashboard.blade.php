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

            @if(isset($pengajuanTerbaru) && $pengajuanTerbaru)
            <div class="mb-10 p-1 border-transparent rounded-[2rem] bg-gradient-to-r 
                {{ $pengajuanTerbaru->status == 'Diterima' ? 'from-emerald-400 to-teal-500 shadow-emerald-100' : 
                ($pengajuanTerbaru->status == 'Ditolak' ? 'from-rose-400 to-orange-500 shadow-rose-100' : 'from-amber-400 to-yellow-500 shadow-amber-100') }} 
                shadow-2xl">
                <div class="bg-white rounded-[1.9rem] p-6 flex flex-col md:flex-row items-center justify-between gap-4">
                    <div class="flex items-center gap-5">
                        <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-white shadow-lg
                            {{ $pengajuanTerbaru->status == 'Diterima' ? 'bg-emerald-500' : ($pengajuanTerbaru->status == 'Ditolak' ? 'bg-rose-500' : 'bg-amber-500 animate-pulse') }}">
                            @if($pengajuanTerbaru->status == 'Diterima') 
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            @elseif($pengajuanTerbaru->status == 'Ditolak') 
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/></svg>
                            @else 
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            @endif
                        </div>
                        <div>
                            <h4 class="text-sm font-black uppercase tracking-widest {{ $pengajuanTerbaru->status == 'Diterima' ? 'text-emerald-600' : ($pengajuanTerbaru->status == 'Ditolak' ? 'text-rose-600' : 'text-amber-600') }}">
                                Update Status Pengajuan
                            </h4>
                            <p class="text-gray-800 font-bold italic uppercase">
                                {{ $pengajuanTerbaru->beasiswa->nama }} : 
                                <span class="not-italic font-black underline decoration-2 underline-offset-4">
                                    {{ $pengajuanTerbaru->status }}
                                </span>
                            </p>
                        </div>
                    </div>
                    <a href="{{ route('mahasiswa.riwayat') }}" class="px-6 py-3 bg-gray-50 hover:bg-gray-100 text-gray-600 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all border border-gray-100">
                        Cek Riwayat Lengkap
                    </a>
                </div>
            </div>
            @endif

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