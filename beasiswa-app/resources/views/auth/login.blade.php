<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Portal - Universitas YARSI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: #f8fafc;
        }
        .emerald-shadow {
            box-shadow: 0 25px 50px -12px rgba(6, 78, 59, 0.15);
        }
        @media (max-width: 640px) {
            .login-card { border-radius: 2.5rem; }
        }
    </style>
</head>
<body class="antialiased overflow-x-hidden">

    <div class="min-h-screen flex items-center justify-center p-4 md:p-6 relative">
        
        <div class="absolute top-[-10%] left-[-10%] w-[50%] h-[50%] bg-emerald-100 rounded-full blur-[120px] opacity-40"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[50%] h-[50%] bg-emerald-200 rounded-full blur-[120px] opacity-40"></div>

        <div class="w-full max-w-[460px] relative z-10">
            
            <div class="bg-white login-card rounded-[3.5rem] emerald-shadow border border-emerald-50 overflow-hidden">
                
                <div class="bg-gradient-to-b from-emerald-50/80 to-white p-8 md:p-12 pb-6 md:pb-8 text-center">
                    <div class="w-20 h-20 bg-[#064e3b] rounded-[2.2rem] flex items-center justify-center text-white font-bold shadow-2xl shadow-emerald-900/30 mx-auto mb-6 transform -rotate-3 hover:rotate-0 transition-transform duration-500">
                        <span class="text-3xl italic">Y</span>
                    </div>
                    <h2 class="text-2xl md:text-3xl font-black text-[#064e3b] tracking-tighter uppercase italic leading-none">
                        Portal <span class="text-[#10b981]">Login</span>
                    </h2>
                    <p class="text-[9px] md:text-[10px] font-bold text-emerald-800/40 uppercase tracking-[0.4em] mt-4">Universitas YARSI Jakarta</p>
                </div>

                <div class="px-8 md:px-12 pb-10 md:pb-12">
                    
                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-50 rounded-2xl border border-red-100">
                            @foreach ($errors->all() as $error)
                                <p class="text-[11px] text-red-600 font-bold italic uppercase tracking-tight">{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    @if (session('status'))
                        <div class="mb-6 p-4 bg-emerald-50 rounded-2xl border border-emerald-100 text-[11px] text-emerald-700 font-bold italic uppercase">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" class="space-y-5">
                        @csrf

                        <div class="space-y-2">
                            <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-emerald-800/60 ml-2">Email Mahasiswa</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus 
                                class="w-full px-6 py-4 bg-emerald-50/40 border-2 border-transparent rounded-2xl focus:bg-white focus:border-emerald-100 focus:ring-0 transition-all duration-300 text-sm font-semibold text-emerald-900 placeholder-emerald-200"
                                placeholder="nim@yarsi.ac.id">
                        </div>

                        <div class="space-y-2">
                            <div class="flex justify-between items-center px-2">
                                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-emerald-800/60">Kata Sandi</label>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-[9px] font-extrabold text-[#10b981] uppercase tracking-widest hover:text-emerald-800 transition-colors">Lupa Sandi?</a>
                                @endif
                            </div>
                            <input id="password" type="password" name="password" required 
                                class="w-full px-6 py-4 bg-emerald-50/40 border-2 border-transparent rounded-2xl focus:bg-white focus:border-emerald-100 focus:ring-0 transition-all duration-300 text-sm font-semibold text-emerald-900 placeholder-emerald-200"
                                placeholder="••••••••">
                        </div>

                        <div class="flex items-center gap-3 px-2">
                            <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 rounded border-emerald-200 text-[#064e3b] focus:ring-emerald-500">
                            <span class="text-[10px] font-bold text-emerald-800/50 uppercase tracking-widest">Ingat Akun Saya</span>
                        </div>

                        <div class="pt-4">
                            <button type="submit" class="w-full py-5 bg-[#064e3b] text-white rounded-2xl font-black uppercase text-[11px] tracking-[0.3em] shadow-xl shadow-emerald-900/20 hover:bg-[#022c22] hover:-translate-y-1 transition-all duration-300 active:scale-95">
                                Masuk ke Portal
                            </button>
                        </div>
                    </form>
                </div>

                <div class="p-8 bg-emerald-50/30 text-center border-t border-emerald-50/50">
                    <p class="text-[10px] font-bold text-emerald-800/40 uppercase tracking-widest italic">
                        Belum terdaftar? 
                        <a href="{{ route('register') }}" class="text-[#10b981] font-black hover:text-[#064e3b] underline decoration-2 underline-offset-4 transition-colors">Daftar Akun Baru</a>
                    </p>
                </div>
            </div>

            <div class="text-center mt-10">
                <a href="/" class="text-[10px] font-black text-emerald-800/30 uppercase tracking-[0.4em] hover:text-[#10b981] transition-all italic">
                    ← Kembali ke Halaman Utama
                </a>
            </div>
        </div>
    </div>

</body>
</html>