<x-admin-layout>
    <div class="max-w-[1440px] mx-auto space-y-10">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h2 class="text-xs font-black text-emerald-600 uppercase tracking-[0.4em] mb-2 text-center md:text-left">Proses Seleksi</h2>
                <h1 class="text-5xl font-black text-gray-900 tracking-tighter uppercase italic leading-none text-center md:text-left">
                    Panel <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-500 not-italic">Monev</span>
                </h1>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all text-center">
                Kembali ke Dashboard
            </a>
        </div>

        <div class="bg-white rounded-[3rem] shadow-2xl shadow-gray-200/50 border border-gray-100 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-900 text-white uppercase italic">
                        <th class="px-8 py-6 text-[10px] font-black tracking-widest">Mahasiswa</th>
                        <th class="px-8 py-6 text-[10px] font-black tracking-widest">Beasiswa</th>
                        <th class="px-8 py-6 text-[10px] font-black tracking-widest text-center">Status</th>
                        <th class="px-8 py-6 text-[10px] font-black tracking-widest text-right">Aksi Keputusan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($pendaftars as $p)
                    <tr class="hover:bg-emerald-50/30 transition-all duration-300">
                        <td class="px-8 py-6">
                            <p class="font-black text-gray-800 uppercase italic text-sm">
                                {{ $p->mahasiswa->nama ?? 'Nama Tidak Terdata' }}
                            </p>
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-tighter">
                                {{ $p->mahasiswa->user->email ?? 'Email tidak ditemukan' }}
                            </p>
                        </td>
                        <td class="px-8 py-6 text-xs font-bold text-gray-500 uppercase italic">
                            {{ $p->beasiswa->nama ?? 'Program Sudah Dihapus' }}
                        </td>
                        <td class="px-8 py-6 text-center">
                            <span class="px-4 py-1.5 rounded-full text-[9px] font-black uppercase italic
                                {{ $p->status == 'Diterima' ? 'bg-emerald-500 text-white' : 
                                ($p->status == 'Ditolak' ? 'bg-rose-500 text-white' : 'bg-amber-400 text-white animate-pulse') }}">
                                {{ $p->status }}
                            </span>
                        </td>
                        <td class="px-8 py-6">
                            <div class="flex justify-end gap-3">
                                <form action="{{ route('admin.monev.update', $p->id) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="Diterima">
                                    <button type="submit" class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white text-[10px] font-black rounded-2xl transition-all shadow-lg shadow-emerald-200 uppercase italic">
                                        Terima
                                    </button>
                                </form>
                                <form action="{{ route('admin.monev.update', $p->id) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="Ditolak">
                                    <button type="submit" class="px-5 py-2.5 bg-white border-2 border-rose-500 text-rose-500 hover:bg-rose-50 text-[10px] font-black rounded-2xl transition-all uppercase italic">
                                        Tolak
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>