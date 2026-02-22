<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('dashboard') }}" class="p-2 bg-white rounded-full shadow-sm hover:bg-gray-50 transition-colors border border-gray-100">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <h2 class="font-extrabold text-2xl text-gray-800 leading-tight">
                {{ __('Detail & Unggah Berkas') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50/50">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('error'))
                <div class="mb-6 p-4 bg-rose-50 border-l-4 border-rose-500 text-rose-700 rounded-r-xl shadow-sm flex items-center">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                    <span class="font-bold text-sm">{{ session('error') }}</span>
                </div>
            @endif

            <div class="bg-white rounded-[2.5rem] shadow-xl shadow-gray-200/50 border border-gray-100 overflow-hidden">
                <div class="p-8 bg-gradient-to-r from-indigo-600 to-blue-500 text-white">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-2xl font-black italic">{{ $beasiswa->nama }}</h3>
                            <p class="text-indigo-100 text-sm mt-1 opacity-90">
                                {{ $sudahDaftar ? 'Terima kasih! Pendaftaran Anda telah kami terima.' : 'Lengkapi dokumen wajib di bawah ini untuk melanjutkan pendaftaran.' }}
                            </p>
                        </div>
                        <div class="hidden md:block">
                            <svg class="w-12 h-12 opacity-20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 14l9-5-9-5-9 5 9 5z"/><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                        </div>
                    </div>
                </div>

                @if($sudahDaftar)
                    <div class="p-12 text-center">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-emerald-50 text-emerald-500 rounded-full mb-6 shadow-inner">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h4 class="text-2xl font-bold text-gray-900 mb-2">Pendaftaran Terkirim</h4>
                        <p class="text-gray-500 max-w-md mx-auto mb-8 text-sm">Anda telah mendaftar untuk beasiswa ini. Silakan pantau perkembangan status seleksi Anda melalui halaman riwayat.</p>
                        <a href="{{ route('mahasiswa.riwayat') }}" class="inline-flex items-center px-8 py-3 bg-indigo-600 text-white rounded-2xl font-bold hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100">
                            Ke Riwayat Pendaftaran
                        </a>
                    </div>
                @else
                    <form action="{{ route('mahasiswa.daftar.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-8">
                        @csrf
                        <input type="hidden" name="beasiswa_id" value="{{ $beasiswa->id }}">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            @forelse($beasiswa->syaratDok as $syarat)
                                <div class="group">
                                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">
                                        {{ $syarat->nama_dokumen }} <span class="text-rose-500">*</span>
                                    </label>
                                    <div class="relative transition-all duration-300">
                                        <input type="file" name="dokumen[{{ $syarat->id }}]" required 
                                            class="block w-full text-sm text-gray-500
                                            file:mr-4 file:py-3 file:px-6
                                            file:rounded-2xl file:border-0
                                            file:text-sm file:font-bold
                                            file:bg-indigo-50 file:text-indigo-700
                                            hover:file:bg-indigo-100
                                            border border-gray-100 rounded-2xl p-2 bg-gray-50/50 focus:ring-4 focus:ring-indigo-100 transition-all">
                                    </div>
                                    <p class="mt-2 text-[10px] text-gray-400 italic ml-1">Format: PDF/JPG/PNG (Max. 2MB)</p>
                                </div>
                            @empty
                                <div class="col-span-full text-center py-12 border-2 border-dashed border-gray-200 rounded-[2rem] bg-gray-50/30">
                                    <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    <p class="text-gray-400 font-medium italic text-sm">Tidak ada dokumen persyaratan khusus.</p>
                                </div>
                            @endforelse
                        </div>

                        <div class="pt-8 border-t border-gray-50 flex flex-col md:flex-row items-center justify-between gap-4">
                            <div class="flex items-center gap-2 text-amber-600 bg-amber-50 px-4 py-2 rounded-xl border border-amber-100">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span class="text-[10px] font-bold uppercase tracking-tight">Periksa kembali berkas Anda sebelum mengirim.</span>
                            </div>
                            
                            <button type="submit" class="w-full md:w-auto px-12 py-4 bg-gray-900 text-white rounded-2xl font-bold hover:bg-indigo-600 hover:shadow-2xl hover:shadow-indigo-200 transition-all duration-300 transform active:scale-95 flex items-center justify-center gap-2">
                                Kirim Pendaftaran
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"/></svg>
                            </button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>