<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                {{ __('Lengkapi Profil Anda') }}
            </h2>
            <p class="text-sm text-gray-500 mt-1 md:mt-0 italic">Pastikan data akademik sesuai dengan KHS/KTM asli.</p>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            @if(!$mahasiswa || empty($mahasiswa->nim))
            <div class="mb-8 p-4 bg-amber-50 border-l-4 border-amber-400 rounded-r-2xl flex items-center gap-4 shadow-sm animate-bounce">
                <div class="p-2 bg-amber-400 rounded-full text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
                <p class="text-amber-700 text-sm font-bold">Mohon lengkapi profil Anda sebelum mendaftar beasiswa!</p>
            </div>
            @endif

            <form action="{{ route('mahasiswa.profil.update') }}" method="POST" class="space-y-8">
                @csrf
                <div class="bg-white rounded-[2.5rem] shadow-xl shadow-indigo-100/50 border border-gray-100 overflow-hidden">
                    <div class="p-8 md:p-12">
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            
                            <div class="col-span-full">
                                <label class="block text-xs font-black uppercase tracking-widest text-indigo-600 mb-2 italic">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $mahasiswa->nama_lengkap ?? '') }}" 
                                    class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-4 focus:ring-indigo-100 transition-all font-bold text-gray-800" placeholder="Masukkan nama sesuai ijazah">
                            </div>

                            <div>
                                <label class="block text-xs font-black uppercase tracking-widest text-indigo-600 mb-2 italic">NIM</label>
                                <input type="text" name="nim" value="{{ old('nim', $mahasiswa->nim ?? '') }}" 
                                    class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-4 focus:ring-indigo-100 transition-all font-bold text-gray-800" placeholder="Contoh: 1402021000">
                            </div>

                            <div>
                                <label class="block text-xs font-black uppercase tracking-widest text-indigo-600 mb-2 italic">Jurusan</label>
                                <select name="jurusan" class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-4 focus:ring-indigo-100 transition-all font-bold text-gray-800">
                                    <option value="">Pilih Jurusan</option>
                                    <option value="Teknik Informatika" {{ (old('jurusan', $mahasiswa->jurusan ?? '') == 'Teknik Informatika') ? 'selected' : '' }}>Teknik Informatika</option>
                                    <option value="Sistem Informasi" {{ (old('jurusan', $mahasiswa->jurusan ?? '') == 'Sistem Informasi') ? 'selected' : '' }}>Sistem Informasi</option>
                                    <option value="Kedokteran" {{ (old('jurusan', $mahasiswa->jurusan ?? '') == 'Kedokteran') ? 'selected' : '' }}>Kedokteran</option>
                                    <option value="Hukum" {{ (old('jurusan', $mahasiswa->jurusan ?? '') == 'Hukum') ? 'selected' : '' }}>Hukum</option>
                                    <option value="Ekonomi" {{ (old('jurusan', $mahasiswa->jurusan ?? '') == 'Ekonomi') ? 'selected' : '' }}>Ekonomi</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-black uppercase tracking-widest text-indigo-600 mb-2 italic">Semester Aktif</label>
                                <input type="number" name="semester" value="{{ old('semester', $mahasiswa->semester ?? '') }}" 
                                    class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-4 focus:ring-indigo-100 transition-all font-bold text-gray-800" placeholder="1 - 14">
                            </div>

                            <div>
                                <label class="block text-xs font-black uppercase tracking-widest text-indigo-600 mb-2 italic">IPK Terakhir</label>
                                <input type="text" name="ipk" value="{{ old('ipk', $mahasiswa->ipk ?? '') }}" 
                                    class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-4 focus:ring-indigo-100 transition-all font-bold text-gray-800" placeholder="Contoh: 3.75">
                            </div>

                            <div class="col-span-full">
                                <label class="block text-xs font-black uppercase tracking-widest text-indigo-600 mb-2 italic">Nomor WhatsApp Aktif</label>
                                <div class="relative">
                                    <span class="absolute left-6 top-1/2 -translate-y-1/2 font-bold text-gray-400">+62</span>
                                    <input type="text" name="no_hp" value="{{ old('no_hp', $mahasiswa->no_hp ?? '') }}" 
                                        class="w-full pl-16 pr-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-4 focus:ring-indigo-100 transition-all font-bold text-gray-800" placeholder="8123456789">
                                </div>
                            </div>
                        </div>

                        <div class="mt-12">
                            <button type="submit" class="w-full py-5 bg-gradient-to-r from-indigo-600 to-blue-500 text-white font-black uppercase tracking-widest rounded-3xl shadow-lg shadow-indigo-200 hover:scale-[1.02] active:scale-95 transition-all duration-300">
                                Simpan Perubahan Profil
                            </button>
                        </div>

                    </div>
                </div>
            </form>

            <div class="mt-8 text-center">
                <a href="{{ route('mahasiswa.dashboard') }}" class="text-sm font-bold text-gray-400 hover:text-indigo-600 transition-colors uppercase tracking-widest italic">
                    ← Kembali ke Dashboard
                </a>
            </div>

        </div>
    </div>
</x-app-layout>