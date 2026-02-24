<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Beasiswa - Universitas YARSI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; scroll-behavior: smooth; }
        .glass { background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(12px); }
        
        .text-emerald-yarsi { color: #064e3b; }
        .bg-emerald-yarsi { background-color: #064e3b; }
        .bg-emerald-darker { background-color: #022c22; }
        .text-accent-mint { color: #10b981; }
        .bg-accent-mint { background-color: #10b981; }
        
        [x-cloak] { display: none !important; }
        .fade-in { animation: fadeIn 1s ease-in; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 overflow-x-hidden">

    <nav class="fixed w-full z-50 glass border-b border-emerald-100">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-emerald-yarsi rounded-2xl flex items-center justify-center text-white font-bold shadow-lg text-xl">Y</div>
                <div class="flex flex-col">
                    <span class="font-extrabold text-lg tracking-tighter leading-none text-emerald-yarsi uppercase italic">BEASISWA <span class="text-accent-mint">YARSI</span></span>
                    <span class="text-[8px] font-bold tracking-[0.2em] text-emerald-800/60 uppercase">Universitas Yarsi</span>
                </div>
            </div>
            <div class="hidden md:flex items-center gap-8 text-xs font-bold uppercase tracking-widest text-emerald-900/70">
                <a href="#profil" class="hover:text-accent-mint transition-colors">Profil</a>
                <a href="#beasiswa" class="hover:text-accent-mint transition-colors">Beasiswa</a>
                <a href="#alur" class="hover:text-accent-mint transition-colors">Alur</a>
                <a href="#faq" class="hover:text-accent-mint transition-colors">FAQ</a>
            </div>
            <div class="flex gap-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-6 py-2.5 bg-emerald-yarsi text-white rounded-xl text-xs font-bold uppercase tracking-widest">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="px-6 py-2.5 text-emerald-800 text-xs font-bold uppercase tracking-widest hover:text-accent-mint">Login</a>
                    <a href="{{ route('register') }}" class="px-6 py-2.5 bg-emerald-yarsi text-white rounded-xl text-xs font-bold uppercase tracking-widest hover:shadow-xl transition-all">Daftar Akun</a>
                @endauth
            </div>
        </div>
    </nav>

    <section id="profil" class="pt-40 pb-20 px-6 bg-gradient-to-b from-emerald-50/50 to-slate-50">
        <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-16 items-center">
            <div class="fade-in">
                <h2 class="text-accent-mint font-bold uppercase tracking-[0.3em] text-xs mb-4">Profil Kampus</h2>
                <h1 class="text-5xl md:text-6xl font-extrabold text-emerald-yarsi leading-tight mb-6 uppercase italic">Pendidikan <span class="text-accent-mint italic">Unggul</span> Berbasis Islami.</h1>
                <p class="text-slate-600 leading-relaxed mb-8 text-lg">Universitas YARSI merupakan institusi pendidikan tinggi terakreditasi UNGGUL di Jakarta yang mencetak lulusan profesional berkarakter Islami.</p>
                <div class="grid grid-cols-2 gap-6 text-center italic uppercase">
                    <div class="p-6 bg-white rounded-3xl shadow-sm border border-emerald-50"><p class="text-3xl font-black text-emerald-yarsi mb-1 italic uppercase">A</p><p class="text-[10px] font-bold uppercase text-slate-400">Akreditasi BAN-PT</p></div>
                    <div class="p-6 bg-white rounded-3xl shadow-sm border border-emerald-50"><p class="text-3xl font-black text-accent-mint mb-1 italic uppercase">WCU</p><p class="text-[10px] font-bold uppercase text-slate-400">World Class Univ</p></div>
                </div>
            </div>
            <div class="relative"><div class="rounded-[4rem] overflow-hidden shadow-2xl h-[450px] border-[12px] border-white"><img src="https://www.yarsi.ac.id/wp-content/uploads/2018/06/slider-home.jpg" class="w-full h-full object-cover"></div></div>
        </div>
    </section>

    <section id="beasiswa" class="py-24 bg-emerald-darker relative">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h3 class="text-5xl font-black text-white italic uppercase tracking-tighter mb-16 italic uppercase">Program <span class="text-accent-mint italic uppercase">Beasiswa</span></h3>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="p-10 rounded-[3rem] bg-white/5 border border-white/10 hover:border-accent-mint transition-all">
                    <h4 class="text-2xl font-bold text-white mb-2 italic uppercase italic uppercase">KIP Kuliah</h4>
                    <p class="text-xs text-emerald-300/60 mb-8 uppercase tracking-widest italic uppercase">Mahasiswa Baru</p>
                    <a href="{{ route('register') }}" class="block text-center py-4 bg-white text-emerald-yarsi rounded-2xl font-black uppercase text-xs">Daftar</a>
                </div>
                <div class="p-10 rounded-[3rem] bg-white/5 border border-white/10 hover:border-accent-mint transition-all">
                    <h4 class="text-2xl font-bold text-white mb-2 italic uppercase italic uppercase">Baznas</h4>
                    <p class="text-xs text-emerald-300/60 mb-8 uppercase tracking-widest italic uppercase">Mahasiswa Aktif</p>
                    <a href="#" class="block text-center py-4 border border-white/20 text-white rounded-2xl font-black uppercase text-xs">Detail</a>
                </div>
                <div class="p-10 rounded-[3rem] bg-white/5 border border-white/10 hover:border-accent-mint transition-all">
                    <h4 class="text-2xl font-bold text-white mb-2 italic uppercase italic uppercase">Prestasi</h4>
                    <p class="text-xs text-emerald-300/60 mb-8 uppercase tracking-widest italic uppercase">Hafidz & Akademik</p>
                    <a href="#" class="block text-center py-4 border border-white/20 text-white rounded-2xl font-black uppercase text-xs">Pelajari</a>
                </div>
            </div>
        </div>
    </section>

    <section id="alur" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h3 class="text-4xl font-black text-emerald-yarsi italic uppercase mb-16 tracking-tighter italic uppercase">Alur <span class="text-accent-mint italic uppercase">Pendaftaran</span></h3>
            <div class="grid md:grid-cols-4 gap-8">
                <div class="p-8 group">
                    <div class="w-16 h-16 bg-emerald-50 text-emerald-yarsi rounded-2xl flex items-center justify-center text-2xl font-black mb-6 mx-auto group-hover:bg-emerald-yarsi group-hover:text-white transition-all italic uppercase shadow-sm italic uppercase text-center">01</div>
                    <h4 class="font-bold text-emerald-900 mb-2 italic uppercase">Registrasi</h4>
                    <p class="text-sm text-slate-500 italic uppercase">Buat akun pada portal beasiswa menggunakan data valid.</p>
                </div>
                <div class="p-8 group">
                    <div class="w-16 h-16 bg-emerald-50 text-emerald-yarsi rounded-2xl flex items-center justify-center text-2xl font-black mb-6 mx-auto group-hover:bg-emerald-yarsi group-hover:text-white transition-all italic uppercase shadow-sm italic uppercase text-center">02</div>
                    <h4 class="font-bold text-emerald-900 mb-2 italic uppercase">Pilih Program</h4>
                    <p class="text-sm text-slate-500 italic uppercase">Pilih kategori beasiswa yang sesuai dengan kualifikasi Anda.</p>
                </div>
                <div class="p-8 group">
                    <div class="w-16 h-16 bg-emerald-50 text-emerald-yarsi rounded-2xl flex items-center justify-center text-2xl font-black mb-6 mx-auto group-hover:bg-emerald-yarsi group-hover:text-white transition-all italic uppercase shadow-sm italic uppercase text-center">03</div>
                    <h4 class="font-bold text-emerald-900 mb-2 italic uppercase">Verifikasi</h4>
                    <p class="text-sm text-slate-500 italic uppercase">Unggah berkas dan tunggu proses seleksi administrasi.</p>
                </div>
                <div class="p-8 group">
                    <div class="w-16 h-16 bg-accent-mint text-white rounded-2xl flex items-center justify-center text-2xl font-black mb-6 mx-auto shadow-lg shadow-emerald-200 italic uppercase text-center">04</div>
                    <h4 class="font-bold text-emerald-900 mb-2 italic uppercase">Hasil</h4>
                    <p class="text-sm text-slate-500 italic uppercase">Cek status kelulusan Anda melalui dashboard akun.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-emerald-50/30 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6">
            <h3 class="text-center text-4xl font-black mb-16 text-emerald-yarsi tracking-tighter italic uppercase text-center">Mahasiswa <span class="text-accent-mint italic uppercase">Berprestasi</span></h3>
            <div x-data="{ 
                activeSlide: 0, 
                slides: [
                    { img: 'https://www.yarsi.ac.id/wp-content/uploads/2023/05/prestasi-1.jpg', name: 'Zahra Annisa', desc: 'Juara 1 Olimpiade Kedokteran Nasional.' },
                    { img: 'https://www.yarsi.ac.id/wp-content/uploads/2023/05/prestasi-2.jpg', name: 'Budi Raharjo', desc: 'Pengembang Aplikasi Syariah Terintegrasi AI.' }
                ],
                next() { this.activeSlide = (this.activeSlide + 1) % this.slides.length },
                prev() { this.activeSlide = (this.activeSlide - 1 + this.slides.length) % this.slides.length }
            }" class="relative group">
                <div class="overflow-hidden rounded-[4rem] border border-white shadow-2xl">
                    <div class="flex transition-transform duration-700 ease-in-out" :style="`transform: translateX(-${activeSlide * 100}%)`">
                        <template x-for="slide in slides" :key="slide.name">
                            <div class="min-w-full px-4"><div class="bg-white p-10 md:p-16 flex flex-col md:flex-row gap-12 items-center"><img :src="slide.img" class="w-full md:w-1/2 h-96 object-cover rounded-[3rem] shadow-lg"><div><h4 x-text="slide.name" class="text-3xl font-bold mb-4 text-emerald-yarsi italic uppercase"></h4><p x-text="slide.desc" class="text-slate-500 text-xl italic mb-8"></p><div class="w-24 h-1.5 bg-accent-mint rounded-full"></div></div></div></div>
                        </template>
                    </div>
                </div>
                <button @click="prev()" class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/90 p-4 rounded-full shadow-lg text-emerald-yarsi hover:bg-emerald-yarsi hover:text-white transition-all z-10 italic uppercase">←</button>
                <button @click="next()" class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/90 p-4 rounded-full shadow-lg text-emerald-yarsi hover:bg-emerald-yarsi hover:text-white transition-all z-10 italic uppercase">→</button>
            </div>
        </div>
    </section>

    <section id="faq" class="py-24 bg-white">
        <div class="max-w-3xl mx-auto px-6">
            <h3 class="text-center text-4xl font-black mb-12 text-emerald-yarsi italic uppercase text-center">Tanya <span class="text-accent-mint italic uppercase">Jawab</span></h3>
            <div x-data="{ active: 1 }" class="space-y-4">
                <div class="border border-emerald-50 bg-slate-50/50 rounded-3xl overflow-hidden">
                    <button @click="active = (active === 1 ? null : 1)" class="w-full px-8 py-6 flex justify-between items-center font-bold text-emerald-900 italic uppercase"><span>Apakah ada tes seleksi lanjutan?</span><span x-text="active === 1 ? '−' : '+'" class="text-2xl text-accent-mint italic uppercase"></span></button>
                    <div x-show="active === 1" x-cloak class="px-8 pb-6 text-slate-500 italic uppercase text-sm">Beberapa program seperti Hafidz memerlukan verifikasi langsung (tes hafalan), sedangkan KIP-K fokus pada seleksi berkas dan survei.</div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-emerald-darker py-20 text-emerald-100/40 italic uppercase">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <div class="w-16 h-16 bg-emerald-yarsi rounded-2xl flex items-center justify-center font-bold text-white text-2xl mb-6 mx-auto">Y</div>
            <p class="text-white font-black uppercase tracking-widest text-xl italic uppercase">Universitas YARSI</p>
            <div class="h-px bg-white/5 w-full my-10"></div>
            <p class="text-[9px] font-bold uppercase tracking-[0.5em] italic uppercase">&copy; 2026 Portal Beasiswa YARSI. All Rights Reserved.</p>
        </div>
    </footer>

</body>
</html>