<x-admin-layout>
    <div class="max-w-[1440px] mx-auto space-y-10">
        
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h2 class="text-xs font-black text-emerald-600 uppercase tracking-[0.4em] mb-2">Internal Monitoring</h2>
                <h1 class="text-5xl font-black text-gray-900 tracking-tighter uppercase italic leading-none">
                    Beasiswa <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-500 not-italic">Yarsi</span>
                </h1>
                <p class="text-gray-400 mt-3 font-medium text-sm italic">Sistem Informasi Manajemen Beasiswa Terpadu</p>
            </div>
            <div class="flex items-center gap-3">
                <div class="text-right hidden md:block">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Status Server</p>
                    <p class="text-sm font-bold text-emerald-600 italic">Online & Aktif</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
                $statCards = [
                    ['label' => 'Total Mahasiswa', 'value' => $stats['total_mahasiswa'] ?? 0, 'color' => 'emerald'],
                    ['label' => 'Jenis Beasiswa', 'value' => $stats['total_beasiswa'] ?? 0, 'color' => 'emerald'],
                    ['label' => 'Total Pendaftar', 'value' => $stats['total_pengajuan'] ?? 0, 'color' => 'emerald'],
                    ['label' => 'Pending Review', 'value' => $stats['pending_review'] ?? 0, 'color' => 'rose'],
                ];
            @endphp

            @foreach($statCards as $card)
            <div class="bg-white p-8 rounded-[2.5rem] border border-gray-50 shadow-[0_20px_50px_rgba(0,0,0,0.02)] group hover:-translate-y-1 transition-all duration-500">
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-1">{{ $card['label'] }}</p>
                <h3 class="text-5xl font-black {{ $card['color'] == 'rose' ? 'text-rose-500' : 'text-emerald-600' }} italic tracking-tighter transition-colors">
                    {{ $card['value'] }}
                </h3>
                <div class="mt-4 flex items-center gap-2">
                    <span class="w-8 h-[2px] bg-gray-100 group-hover:bg-emerald-200 transition-colors"></span>
                    <span class="text-[9px] font-black text-gray-300 uppercase tracking-widest">Update Real-time</span>
                </div>
            </div>
            @endforeach
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 bg-white p-10 rounded-[3.5rem] border border-gray-50 shadow-sm overflow-hidden relative">
                <div class="flex justify-between items-center mb-10">
                    <div>
                        <h3 class="font-black text-gray-800 uppercase italic tracking-widest text-sm">Visualisasi Data</h3>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-tight">Perbandingan Status Pengajuan</p>
                    </div>
                </div>
                <div class="h-[350px] relative">
                    <canvas id="yarsiChart"></canvas>
                </div>
            </div>

            <div class="bg-gray-900 p-10 rounded-[3.5rem] text-white shadow-2xl shadow-emerald-100 flex flex-col overflow-hidden relative">
                <div class="absolute top-0 right-0 -mr-20 -mt-20 w-64 h-64 bg-emerald-500 rounded-full blur-[100px] opacity-20"></div>
                
                <h3 class="font-black uppercase italic tracking-widest text-sm mb-8 relative z-10">Antrean Terbaru</h3>
                <div class="space-y-6 relative z-10 flex-1 overflow-y-auto max-h-[350px] pr-2 custom-scrollbar">
                    @forelse($recentApplications as $app)
                    <div class="flex items-center gap-4 group">
                        <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center font-black text-emerald-400 border border-white/5 transition-all group-hover:bg-emerald-600 group-hover:text-white">
                            {{ substr($app->user->name ?? '?', 0, 1) }}
                        </div>
                        <div class="flex-1">
                            <p class="text-xs font-black uppercase italic tracking-tight">
                                {{ Str::limit($app->user->name ?? 'User Tidak Ada', 20) }}
                            </p>
                            <p class="text-[10px] text-gray-500 uppercase tracking-widest mt-0.5">
                                {{ $app->beasiswa->nama ?? 'Program Beasiswa' }}
                            </p>
                        </div>
                        <div class="px-3 py-1 bg-emerald-500/10 text-emerald-400 rounded-full text-[8px] font-black uppercase tracking-tighter">Baru</div>
                    </div>
                    @empty
                    <div class="text-center py-20">
                        <p class="text-gray-500 italic text-sm">Tidak ada data pendaftaran.</p>
                    </div>
                    @endforelse
                </div>

                <a href="#" class="mt-8 w-full py-4 bg-emerald-600 hover:bg-emerald-500 text-white rounded-2xl font-black text-[10px] uppercase tracking-[0.2em] transition-all relative z-10 text-center shadow-xl shadow-emerald-900/40">
                    Buka Panel Monev
                </a>
            </div>
        </div>
    </div>
</x-admin-layout>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('yarsiChart').getContext('2d');
        
        // Data dikirim secara dinamis dari AdminController@index
        const chartDataValues = {!! json_encode($chartData['data'] ?? [0,0,0]) !!};

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Diterima', 'Pending', 'Ditolak'],
                datasets: [{
                    data: chartDataValues,
                    backgroundColor: ['#10b981', '#fbbf24', '#f43f5e'],
                    hoverOffset: 25,
                    borderWidth: 0,
                    spacing: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '85%', // Membuat ring donut tipis dan modern
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 30,
                            usePointStyle: true,
                            font: { weight: 'bold', family: 'Inter', size: 12 }
                        }
                    }
                }
            }
        });
    });
</script>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(16, 185, 129, 0.2); border-radius: 10px; }
</style>