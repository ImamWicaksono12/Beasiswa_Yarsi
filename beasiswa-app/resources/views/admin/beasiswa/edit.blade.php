<x-admin-layout>
    <div class="max-w-[800px] mx-auto space-y-10">
        
        <div class="flex items-center gap-6">
            <a href="{{ route('admin.beasiswa.index') }}" class="p-4 bg-white rounded-2xl shadow-sm hover:bg-gray-50 transition-all group border border-gray-100">
                <svg class="w-5 h-5 text-gray-400 group-hover:text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <div>
                <h2 class="text-xs font-black text-emerald-600 uppercase tracking-[0.4em] mb-1">Editor Mode</h2>
                <h1 class="text-4xl font-black text-gray-900 tracking-tighter uppercase italic">
                    Edit <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-500 not-italic">Program</span>
                </h1>
            </div>
        </div>

        <div class="bg-white rounded-[3.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.02)] border border-gray-100 overflow-hidden relative">
            <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-500/5 rounded-full -mr-16 -mt-16 blur-3xl"></div>

            <form action="{{ route('admin.beasiswa.update', $beasiswa->id) }}" method="POST" class="p-12 space-y-8 relative z-10">
                @csrf
                @method('PATCH')

                <div class="grid grid-cols-1 gap-8">
                    <div class="space-y-3">
                        <label class="block text-[10px] font-black uppercase text-gray-400 tracking-[0.2em] ml-2">Nama Program Beasiswa</label>
                        <input type="text" name="nama" value="{{ old('nama', $beasiswa->nama) }}" required 
                            class="w-full border-none bg-gray-50 rounded-[1.5rem] focus:ring-2 focus:ring-emerald-500 font-bold text-gray-700 p-5 transition-all text-lg">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-3">
                            <label class="block text-[10px] font-black uppercase text-gray-400 tracking-[0.2em] ml-2">Kuota (Orang)</label>
                            <input type="number" name="kuota" value="{{ old('kuota', $beasiswa->kuota) }}" required 
                                class="w-full border-none bg-gray-50 rounded-[1.5rem] focus:ring-2 focus:ring-emerald-500 font-bold text-gray-700 p-5 transition-all">
                        </div>
                        <div class="space-y-3">
                            <label class="block text-[10px] font-black uppercase text-gray-400 tracking-[0.2em] ml-2">Tahun Periode</label>
                            <input type="text" name="periode" value="{{ old('periode', $beasiswa->periode) }}" placeholder="2025/2026" required 
                                class="w-full border-none bg-gray-50 rounded-[1.5rem] focus:ring-2 focus:ring-emerald-500 font-bold text-gray-700 p-5 transition-all">
                        </div>
                    </div>

                    <div class="space-y-3">
                        <label class="block text-[10px] font-black uppercase text-gray-400 tracking-[0.2em] ml-2">Deskripsi & Cakupan</label>
                        <textarea name="deskripsi" rows="5" required
                            class="w-full border-none bg-gray-50 rounded-[1.5rem] focus:ring-2 focus:ring-emerald-500 font-bold text-gray-700 p-6 transition-all">{{ old('deskripsi', $beasiswa->deskripsi) }}</textarea>
                    </div>
                </div>

                <div class="pt-6 flex flex-col md:flex-row items-center gap-4">
                    <button type="submit" 
                        class="w-full md:flex-1 py-5 bg-emerald-600 text-white rounded-2xl font-black shadow-xl shadow-emerald-100 uppercase text-[10px] tracking-widest hover:bg-gray-900 hover:-translate-y-1 transition-all">
                        Simpan Perubahan
                    </button>
                    
                    <a href="{{ route('admin.beasiswa.index') }}" 
                        class="w-full md:w-auto px-10 py-5 text-gray-400 font-black uppercase text-[10px] tracking-widest hover:text-rose-500 transition-colors text-center">
                        Batalkan
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>