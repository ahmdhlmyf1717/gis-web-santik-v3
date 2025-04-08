@include('layouts.navigation')
@include('partials.loading')

@extends('layouts.app')

@section('title', 'Dashboard')

@section('header')
    {{ __('Dashboard') }}
@endsection

@section('content')
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
                    class="bg-white p-6 shadow-lg rounded-lg flex items-center justify-between border-t-4 border-green-500 transition-transform transform hover:scale-105">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">{{ $card['label'] }}</h3>
                        <p class="text-3xl font-bold text-green-600">{{ $card['value'] }}</p>
                    </div>
                    <i class="{{ $card['icon'] }} text-green-500 text-4xl"></i>
                </div>
            @endforeach
        </div>

        <!-- Grafik Statistik -->
        <div class="bg-white p-6 shadow-lg rounded-lg">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Statistik Data</h3>
            <canvas id="dashboardChart"></canvas>
        </div>

        <!-- Aktivitas Terbaru & Data Terbaru -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach (['Aktivitas Terbaru', 'Data Terbaru'] as $section)
                <div class="bg-white p-6 shadow-lg rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">{{ $section }}</h3>
                    <div class="space-y-2">
                        @for ($i = 0; $i < 3; $i++)
                            <div class="p-2 border border-gray-200 rounded-lg hover:bg-gray-50 transition-all">
                                {{ $section === 'Aktivitas Terbaru' ? 'Admin melakukan perubahan' : 'Dataset Baru Ditambahkan' }}
                            </div>
                        @endfor
                    </div>
                </div>
            @endforeach
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
                        backgroundColor: ['#66bb6a', '#ffd54f', '#42a5f5'],
                        borderRadius: 5,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top'
                        },
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        },
                    }
                }
            });
        });
    </script>
@endsection
