<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    {{ __('Riwayat Aktivitas') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">Pantau status pengajuan beasiswa Anda secara real-time.</p>
            </div>
            <div class="mt-4 md:mt-0">
                <span class="inline-flex items-center px-4 py-2 bg-indigo-50 text-indigo-700 text-xs font-bold rounded-full border border-indigo-100 shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ $pengajuans->count() }} Total Pengajuan
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50/50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 flex items-center p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 rounded-r-xl shadow-sm">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 flex items-center p-4 bg-rose-50 border-l-4 border-rose-500 text-rose-700 rounded-r-xl shadow-sm">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                    <span class="font-medium">{{ session('error') }}</span>
                </div>
            @endif

            <div class="bg-white rounded-[2rem] shadow-xl shadow-gray-200/50 border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/80">
                                <th class="px-8 py-5 text-xs font-bold uppercase tracking-wider text-gray-400 border-b border-gray-100">Informasi Beasiswa</th>
                                <th class="px-8 py-5 text-xs font-bold uppercase tracking-wider text-gray-400 border-b border-gray-100 text-center">Tanggal Pengajuan</th>
                                <th class="px-8 py-5 text-xs font-bold uppercase tracking-wider text-gray-400 border-b border-gray-100 text-center">Status Terkini</th>
                                <th class="px-8 py-5 text-xs font-bold uppercase tracking-wider text-gray-400 border-b border-gray-100 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($pengajuans as $p)
                                <tr class="hover:bg-indigo-50/30 transition-colors duration-200">
                                    <td class="px-8 py-6">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 flex-shrink-0 rounded-xl bg-indigo-600 flex items-center justify-center text-white shadow-lg shadow-indigo-150">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.168.477 4.492 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.492 1.253"></path></svg>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-bold text-gray-900">{{ $p->beasiswa->nama ?? 'Beasiswa Tidak Ditemukan' }}</div>
                                                <div class="text-xs text-gray-400 mt-0.5 font-mono italic">#SCH-{{ str_pad($p->id, 3, '0', STR_PAD_LEFT) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6 text-sm text-gray-600 font-medium text-center">
                                        {{ \Carbon\Carbon::parse($p->tanggal)->translatedFormat('d F Y') }}
                                        <span class="block text-[10px] text-gray-400 font-normal">Pukul {{ \Carbon\Carbon::parse($p->created_at)->format('H:i') }} WIB</span>
                                    </td>
                                    <td class="px-8 py-6 text-center">
                                        @if($p->status == 'Pending')
                                            <span class="inline-flex items-center px-3 py-1 bg-amber-50 text-amber-600 text-[11px] font-bold rounded-lg border border-amber-100">
                                                <span class="w-1.5 h-1.5 bg-amber-500 rounded-full mr-2 animate-pulse"></span>
                                                Dalam Review
                                            </span>
                                        @elseif($p->status == 'Diterima')
                                            <span class="inline-flex items-center px-3 py-1 bg-emerald-50 text-emerald-600 text-[11px] font-bold rounded-lg border border-emerald-100">
                                                <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full mr-2"></span>
                                                Lolos Seleksi
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 bg-rose-50 text-rose-600 text-[11px] font-bold rounded-lg border border-rose-100">
                                                <span class="w-1.5 h-1.5 bg-rose-500 rounded-full mr-2"></span>
                                                Belum Lolos
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-8 py-6 text-right">
                                        <button class="p-2 text-gray-400 hover:bg-gray-100 hover:text-indigo-600 rounded-full transition-all" title="Detail Pengajuan">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-8 py-24 text-center">
                                        <div class="flex flex-col items-center">
                                            <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" class="w-24 h-24 opacity-20 grayscale mb-4" alt="Empty">
                                            <p class="text-gray-400 font-medium text-lg italic">Belum ada jejak pendaftaran...</p>
                                            <a href="{{ route('dashboard') }}" class="mt-4 px-6 py-2 bg-indigo-600 text-white rounded-full text-sm font-bold shadow-lg shadow-indigo-200 hover:bg-indigo-700 transition-all">
                                                Mulai Cari Beasiswa Sekarang
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>