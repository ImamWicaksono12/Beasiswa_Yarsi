<x-admin-layout>
    <div class="max-w-[1440px] mx-auto space-y-10">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <h2 class="text-xs font-black text-emerald-600 uppercase tracking-[0.4em] mb-2">Inventory System</h2>
                <h1 class="text-5xl font-black text-gray-900 tracking-tighter uppercase italic leading-none">
                    Manajemen <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-500 not-italic">Program</span>
                </h1>
                <p class="text-gray-400 mt-3 font-medium text-sm italic">Kelola seluruh program beasiswa aktif dan pantau jumlah pendaftar secara real-time.</p>
            </div>

            <div>
                <button onclick="document.getElementById('modalTambah').classList.remove('hidden')" 
                class="inline-flex items-center gap-3 px-8 py-4 bg-gray-900 text-white rounded-2xl font-black text-[10px] uppercase tracking-widest shadow-2xl shadow-gray-200 hover:bg-emerald-600 hover:-translate-y-1 transition-all group">
                    <svg class="w-5 h-5 text-emerald-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Beasiswa Baru
                </button>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-emerald-500 text-white p-4 rounded-2xl font-bold uppercase text-[10px] tracking-widest">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-rose-500 text-white p-4 rounded-2xl font-bold uppercase text-[10px] tracking-widest">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white rounded-[3.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.02)] border border-gray-50 overflow-hidden transition-all">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50">
                            <th class="px-10 py-8 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Informasi Beasiswa</th>
                            <th class="px-10 py-8 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] text-center">Kuota</th>
                            <th class="px-10 py-8 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] text-center">Pendaftar</th>
                            <th class="px-10 py-8 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] text-center">Periode</th>
                            <th class="px-10 py-8 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($beasiswas as $b)
                        <tr class="hover:bg-emerald-50/30 transition-colors group">
                            <td class="px-10 py-8">
                                <div class="flex flex-col">
                                    <span class="text-sm font-black text-gray-900 uppercase italic tracking-tight group-hover:text-emerald-600 transition-colors">{{ $b->nama }}</span>
                                    <span class="text-[10px] text-gray-400 font-medium mt-1 italic line-clamp-1">{{ $b->deskripsi }}</span>
                                </div>
                            </td>
                            <td class="px-10 py-8 text-center">
                                <span class="inline-block px-4 py-2 bg-gray-100 text-gray-600 rounded-xl text-xs font-black italic border border-gray-200/50">
                                    {{ $b->kuota }}
                                </span>
                            </td>
                            <td class="px-10 py-8 text-center">
                                <span class="text-xs font-bold text-emerald-600 italic uppercase bg-emerald-50 px-3 py-1 rounded-lg">
                                    {{ $b->pengajuans_count ?? 0 }} Orang
                                </span>
                            </td>
                            <td class="px-10 py-8 text-center text-[10px] font-black text-gray-400 tracking-widest uppercase italic">
                                {{ $b->periode }}
                            </td>
                            <td class="px-10 py-8 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.beasiswa.edit', $b->id) }}" class="p-3 bg-gray-50 text-gray-400 rounded-xl hover:bg-emerald-600 hover:text-white transition-all shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.beasiswa.destroy', $b->id) }}" method="POST" onsubmit="return confirm('Hapus program ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-3 bg-gray-50 text-gray-400 rounded-xl hover:bg-rose-600 hover:text-white transition-all shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-10 py-20 text-center">
                                <div class="flex flex-col items-center opacity-20">
                                    <svg class="w-12 h-12 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                    <p class="text-sm font-black uppercase italic tracking-widest">Belum ada program beasiswa</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="modalTambah" class="fixed inset-0 bg-gray-900/60 backdrop-blur-md hidden flex items-center justify-center z-[100] p-4 transition-all">
        <div class="bg-white p-8 md:p-10 rounded-[3rem] shadow-2xl w-full max-w-2xl border border-gray-100 relative max-h-[90vh] overflow-y-auto scrollbar-hide">
            <h3 class="text-2xl font-black text-gray-900 mb-8 uppercase tracking-tighter italic">
                Tambah <span class="text-emerald-600">Beasiswa</span>
            </h3>
            
            <form action="{{ route('admin.beasiswa.store') }}" method="POST" class="space-y-6 relative z-10">
                @csrf
                <div>
                    <label class="block text-[10px] font-black uppercase text-gray-400 mb-2 tracking-widest">Nama Beasiswa</label>
                    <input type="text" name="nama" required class="w-full border-none bg-gray-50 rounded-2xl focus:ring-2 focus:ring-emerald-500 font-bold text-gray-700 p-4">
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-black uppercase text-gray-400 mb-2 tracking-widest">Kuota</label>
                        <input type="number" name="kuota" required class="w-full border-none bg-gray-50 rounded-2xl focus:ring-2 focus:ring-emerald-500 font-bold text-gray-700 p-4">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase text-gray-400 mb-2 tracking-widest">Periode</label>
                        <input type="text" name="periode" placeholder="2025/2026" required class="w-full border-none bg-gray-50 rounded-2xl focus:ring-2 focus:ring-emerald-500 font-bold text-gray-700 p-4">
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-black uppercase text-rose-500 mb-2 tracking-widest italic">Batas Pendaftaran (Deadline)</label>
                    <input type="date" name="deadline" required class="w-full border-none bg-rose-50 rounded-2xl focus:ring-2 focus:ring-rose-500 font-bold text-gray-700 p-4">
                </div>

                <div>
                    <label class="block text-[10px] font-black uppercase text-gray-400 mb-2 tracking-widest">Deskripsi Singkat</label>
                    <textarea name="deskripsi" class="w-full border-none bg-gray-50 rounded-2xl focus:ring-2 focus:ring-emerald-500 font-bold text-gray-700 p-4" rows="2"></textarea>
                </div>

                <div>
                    <label class="block text-[10px] font-black uppercase text-emerald-600 mb-3 tracking-widest">Persyaratan Dokumen</label>
                    <div id="syarat-container" class="space-y-3">
                        <div class="flex gap-2">
                            <input type="text" name="syarat[]" placeholder="Contoh: Scan KTP" required class="flex-1 border-none bg-emerald-50/50 rounded-xl focus:ring-2 focus:ring-emerald-500 font-bold text-gray-700 p-3 text-sm">
                            <button type="button" onclick="addSyarat()" class="px-4 bg-emerald-600 text-white rounded-xl font-black">+</button>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-4 pt-4">
                    <button type="button" onclick="document.getElementById('modalTambah').classList.add('hidden')" class="flex-1 py-4 text-gray-400 font-black uppercase text-[10px] tracking-widest hover:text-rose-500 text-center">Batal</button>
                    <button type="submit" class="flex-[2] py-4 bg-gray-900 text-white rounded-2xl font-black shadow-xl uppercase text-[10px] tracking-widest hover:bg-emerald-600 transition-all">Simpan Program</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function addSyarat() {
            const container = document.getElementById('syarat-container');
            const div = document.createElement('div');
            div.className = 'flex gap-2 animate-slide-down mt-2';
            div.innerHTML = `
                <input type="text" name="syarat[]" placeholder="Syarat lainnya..." required class="flex-1 border-none bg-emerald-50/50 rounded-xl focus:ring-2 focus:ring-emerald-500 font-bold text-gray-700 p-3 text-sm">
                <button type="button" onclick="this.parentElement.remove()" class="px-4 bg-rose-500 text-white rounded-xl font-black">-</button>
            `;
            container.appendChild(div);
        }
    </script>
</x-admin-layout>