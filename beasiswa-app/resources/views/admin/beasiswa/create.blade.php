<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-gray-800 leading-tight italic uppercase tracking-tighter">
            {{ __('Tambah Program Beasiswa Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-[2.5rem] shadow-xl border border-gray-100 p-10">
                <form action="{{ route('admin.beasiswa.store') }}" method="POST">
                    @csrf

                    <div class="mb-6">
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Nama Beasiswa</label>
                        <input type="text" name="nama" placeholder="Contoh: Beasiswa BAZNAS 2026" class="w-full rounded-2xl border-gray-100 bg-gray-50 focus:ring-indigo-500 font-bold p-4" required>
                    </div>

                    <div class="grid grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Kuota (Orang)</label>
                            <input type="number" name="kuota" class="w-full rounded-2xl border-gray-100 bg-gray-50 focus:ring-indigo-500 font-bold p-4" required>
                        </div>
                        <div>
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Batas Pendaftaran</label>
                            <input type="date" name="deadline" class="w-full rounded-2xl border-gray-100 bg-gray-50 focus:ring-indigo-500 font-bold p-4" required>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Deskripsi & Cakupan</label>
                        <textarea name="deskripsi" rows="4" placeholder="Jelaskan detail bantuan yang diberikan..." class="w-full rounded-2xl border-gray-100 bg-gray-50 focus:ring-indigo-500 font-medium p-4" required></textarea>
                    </div>

                    <div class="mb-10">
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2 text-indigo-600">Persyaratan Dokumen (PDF)</label>
                        <div id="syarat-container">
                            <div class="flex gap-2 mb-2">
                                <input type="text" name="syarat[]" placeholder="Contoh: Scan KTP" class="flex-1 rounded-2xl border-gray-100 bg-gray-50 focus:ring-indigo-500 font-bold p-4" required>
                                <button type="button" onclick="addSyarat()" class="px-4 bg-indigo-600 text-white rounded-2xl font-black">+</button>
                            </div>
                        </div>
                        <p class="text-[10px] text-gray-400 mt-2 italic">*Klik tombol + untuk menambah syarat dokumen lebih banyak</p>
                    </div>

                    <div class="flex gap-4">
                        <button type="submit" class="flex-1 py-4 bg-indigo-600 text-white rounded-2xl font-black italic uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100">
                            Terbitkan Beasiswa
                        </button>
                        <a href="{{ route('admin.beasiswa.index') }}" class="px-8 py-4 bg-gray-100 text-gray-400 rounded-2xl font-black italic uppercase tracking-widest hover:bg-gray-200 transition-all text-center">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function addSyarat() {
            const container = document.getElementById('syarat-container');
            const div = document.createElement('div');
            div.className = 'flex gap-2 mb-2';
            div.innerHTML = `
                <input type="text" name="syarat[]" placeholder="Syarat selanjutnya..." class="flex-1 rounded-2xl border-gray-100 bg-gray-50 focus:ring-indigo-500 font-bold p-4">
                <button type="button" onclick="this.parentElement.remove()" class="px-4 bg-rose-500 text-white rounded-2xl font-black">-</button>
            `;
            container.appendChild(div);
        }
    </script>
</x-app-layout>