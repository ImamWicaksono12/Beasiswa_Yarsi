<x-admin-layout>
    <div class="max-w-[1400px] mx-auto p-6">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            
            <div class="lg:col-span-4 bg-white p-10 rounded-[3rem] shadow-sm border border-gray-100">
                <div class="flex items-center gap-4 mb-10">
                    <div class="p-3 bg-gray-900 text-white rounded-2xl">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    </div>
                    <h3 class="text-xl font-black italic uppercase">Registrasi Akun</h3>
                </div>

                <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <input type="text" name="username" placeholder="Username Pejabat" required class="w-full px-6 py-4 rounded-2xl bg-gray-50 border-none font-bold">
                    <input type="email" name="email" placeholder="Email Institusi" required class="w-full px-6 py-4 rounded-2xl bg-gray-50 border-none font-bold">
                    
                    <select name="role_id" required class="w-full px-6 py-4 rounded-2xl bg-gray-50 border-none font-black text-indigo-600">
                        <option value="1">ADMIN PUSAT</option>
                        <option value="2">KAPRODI</option>
                        <option value="3">WAKIL DEKAN</option>
                        <option value="5">WAKIL REKTOR (WAREK)</option>
                    </select>

                    <input type="password" name="password" placeholder="Keamanan (Password)" required class="w-full px-6 py-4 rounded-2xl bg-gray-50 border-none font-bold">
                    
                    <button type="submit" class="w-full py-5 bg-gray-900 text-white rounded-[2rem] font-black uppercase tracking-widest hover:bg-indigo-600 transition-all shadow-xl">
                        Simpan Kredensial
                    </button>
                </form>
            </div>

            <div class="lg:col-span-8 bg-white rounded-[3.5rem] shadow-sm border border-gray-50 overflow-hidden">
                <div class="p-10 border-b border-gray-50 flex justify-between items-center bg-gray-50/20">
                    <h3 class="text-sm font-black text-gray-800 uppercase tracking-widest">Direktori Akun Aktif</h3>
                    <span class="px-4 py-2 bg-indigo-50 text-indigo-600 rounded-full text-[10px] font-black uppercase italic">{{ $users->count() }} Terdaftar</span>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-[10px] font-black text-gray-300 uppercase tracking-[0.2em]">
                                <th class="p-8">Pejabat Pengguna</th>
                                <th class="p-8 text-center">Tingkat Akses</th>
                                <th class="p-8 text-right">Manajemen</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($users as $user)
                            <tr class="group hover:bg-indigo-50/20 transition-all">
                                <td class="p-8">
                                    <div class="flex items-center gap-5">
                                        <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center font-black border border-gray-100 text-gray-400">
                                            {{ substr($user->username, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="font-black text-gray-900 text-sm uppercase italic">{{ $user->username }}</div>
                                            <div class="text-[10px] text-gray-400 font-bold tracking-widest uppercase">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-8 text-center">
                                    <span class="px-5 py-2 rounded-full text-[9px] font-black uppercase {{ $user->role_id == 1 ? 'bg-gray-900 text-white' : 'bg-white border text-gray-500' }}">
                                        @if($user->role_id == 1) ADMIN SISTEM 
                                        @elseif($user->role_id == 2) KAPRODI 
                                        @elseif($user->role_id == 3) WAKIL DEKAN 
                                        @elseif($user->role_id == 5) WAREK @else PEJABAT @endif
                                    </span>
                                </td>
                                <td class="p-8 text-right">
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-gray-300 hover:text-rose-500 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="3" class="p-20 text-center text-gray-300 italic uppercase font-black text-xs">Belum ada data</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>