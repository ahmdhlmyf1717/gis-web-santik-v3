<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Kartu Statistik -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @php
                    $cards = [
                        ['label' => 'Total Admin', 'value' => $totalAdmins ?? 10, 'icon' => 'fas fa-user-cog'],
                        ['label' => 'Total Dataset', 'value' => $totalDatasets ?? 25, 'icon' => 'fas fa-database'],
                        ['label' => 'Total Maps', 'value' => $totalMaps ?? 15, 'icon' => 'fas fa-map-marked-alt'],
                    ];
                @endphp
                @foreach ($cards as $card)
                    <div
                        class="bg-white p-6 shadow-lg rounded-lg flex items-center justify-between transition-all duration-200 hover:shadow-xl border-l-8 border-green-500">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">{{ $card['label'] }}</h3>
                            <p class="text-3xl font-bold text-green-600">{{ $card['value'] }}</p>
                        </div>
                        <i class="{{ $card['icon'] }} text-green-500 text-4xl"></i>
                    </div>
                @endforeach
            </div>

            <!-- Grafik Statistik -->
            <div class="bg-white p-6 shadow-lg rounded-lg transition-all duration-200 hover:shadow-xl">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Statistik Data</h3>
                <canvas id="dashboardChart"></canvas>
            </div>

            <!-- Aktivitas Terbaru dan Data Terbaru -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white p-6 shadow-lg rounded-lg transition-all duration-200 hover:shadow-xl">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Aktivitas Terbaru</h3>
                    <ul class="divide-y divide-gray-200">
                        <li class="py-2 text-gray-700">Admin A menambahkan dataset baru</li>
                        <li class="py-2 text-gray-700">Admin B menghapus data lama</li>
                        <li class="py-2 text-gray-700">Admin C memperbarui peta interaktif</li>
                    </ul>
                </div>

                <div class="bg-white p-6 shadow-lg rounded-lg transition-all duration-200 hover:shadow-xl">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Data Terbaru</h3>
                    <table class="w-full border-collapse border border-gray-200 text-sm">
                        <thead>
                            <tr class="bg-green-500 text-white">
                                <th class="py-2 px-3 border">Nama</th>
                                <th class="py-2 px-3 border">Kategori</th>
                                <th class="py-2 px-3 border">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center border-b border-gray-200">
                                <td class="py-2 px-3">Dataset 1</td>
                                <td class="py-2 px-3">Puskesmas</td>
                                <td class="py-2 px-3">-</td>
                            </tr>
                            <tr class="text-center border-b border-gray-200">
                                <td class="py-2 px-3">Dataset 2</td>
                                <td class="py-2 px-3">Cagar Alam</td>
                                <td class="py-2 px-3">-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById('dashboardChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Admin', 'Dataset', 'Maps'],
                    datasets: [{
                        label: 'Jumlah',
                        data: [{{ $totalAdmins ?? 10 }}, {{ $totalDatasets ?? 25 }},
                            {{ $totalMaps ?? 15 }}
                        ],
                        backgroundColor: ['#66bb6a', '#ffd54f', '#42a5f5']
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            enabled: true
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>
