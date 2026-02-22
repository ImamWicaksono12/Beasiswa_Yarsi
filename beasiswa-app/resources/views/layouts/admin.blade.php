<x-admin-layout>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-10">
        <div class="bg-white p-8 rounded-[2.5rem] shadow-xl shadow-gray-200/50 border border-gray-100 transition-all hover:scale-105">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-3">Total Mahasiswa</p>
            <div class="flex items-end justify-between">
                <h3 class="text-5xl font-black text-gray-800 italic">{{ $stats['total_mahasiswa'] }}</h3>
                <div class="w-12 h-12 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-white p-8 rounded-[2.5rem] shadow-xl shadow-gray-200/50 border border-gray-100 transition-all hover:scale-105">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-3">Jenis Beasiswa</p>
            <div class="flex items-end justify-between">
                <h3 class="text-5xl font-black text-gray-800 italic">{{ $stats['total_beasiswa'] }}</h3>
                <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-white p-8 rounded-[2.5rem] shadow-xl shadow-gray-200/50 border border-gray-100 transition-all hover:scale-105">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-3">Total Pendaftar</p>
            <div class="flex items-end justify-between">
                <h3 class="text-5xl font-black text-gray-800 italic">{{ $stats['total_pengajuan'] }}</h3>
                <div class="w-12 h-12 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-white p-8 rounded-[2.5rem] shadow-xl shadow-gray-200/50 border border-gray-100 transition-all hover:scale-105">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-3">Butuh Review</p>
            <div class="flex items-end justify-between">
                <h3 class="text-5xl font-black text-rose-600 italic">{{ $stats['pending_review'] }}</h3>
                <div class="w-12 h-12 bg-rose-50 rounded-2xl flex items-center justify-center text-rose-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-xl shadow-gray-200/50 border border-gray-100 overflow-hidden">
        <div class="p-8 border-b border-gray-50 flex justify-between items-center">
            <h3 class="font-black text-gray-800 italic uppercase tracking-widest text-sm">Pendaftaran Terbaru</h3>
            <a href="{{ route('admin.monev.index') }}" class="text-xs font-black text-indigo-600 hover:text-indigo-800 uppercase tracking-tighter">Lihat Semua →</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50">
                        <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest">Mahasiswa</th>
                        <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest">Beasiswa</th>
                        <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest">Status</th>
                        <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($recentApplications as $app)
                    <tr class="hover:bg-gray-50/30 transition-colors">
                        <td class="px-8 py-5">
                            <p class="font-bold text-gray-800 uppercase text-xs">{{ $app->user->name }}</p>
                        </td>
                        <td class="px-8 py-5">
                            <span class="text-xs font-medium text-gray-500">{{ $app->beasiswa->nama }}</span>
                        </td>
                        <td class="px-8 py-5">
                            <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-tighter 
                                {{ $app->status == 'Pending' ? 'bg-amber-100 text-amber-700' : ($app->status == 'Diterima' ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700') }}">
                                {{ $app->status }}
                            </span>
                        </td>
                        <td class="px-8 py-5 text-xs text-gray-400">
                            {{ $app->created_at->diffForHumans() }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-8 py-10 text-center text-gray-400 italic text-sm">Belum ada data pendaftaran terbaru.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>