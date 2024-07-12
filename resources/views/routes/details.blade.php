<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Langkah-Langkah Perhitungan AHP') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3>Bobot Kriteria (sudah berdasarkan matriks perbandingan):</h3>
                    <div style="margin-bottom: 20px; border: 1px solid #ddd; padding: 10px; border-radius: 5px;">
                        <p><strong>Jarak:</strong> {{ $weights['distance'] }} (cost)</p>
                        <p><strong>Kondisi Jalan:</strong> {{ $weights['road_condition'] }} (benefit)</p>
                        <p><strong>Tingkat Kecelakaan:</strong> {{ $weights['accident_rate'] }} (cost)</p>
                        <p><strong>Ketersediaan Jalur Sepeda:</strong> {{ $weights['bike_lane_availability'] }} (benefit)</p>
                        <p><strong>Jumlah Persimpangan:</strong> {{ $weights['intersection_count'] }} (cost)</p>
                    </div>

                    <h3>Konsistensi: 0,0123987</h3>
                    <p></p>

                    <h3>Langkah-Langkah Perhitungan</h3>
                    <p>Jarak Tempuh yang Diinginkan: {{ $distance }} km</p>
                    
                    @foreach ($alternatives as $route)
                        <div style="margin-bottom: 20px; border: 1px solid #ddd; padding: 10px; border-radius: 5px;">
                            <h4>{{ $route->name }}</h4>
                            <p><strong>Jarak:</strong> {{ $route->distance }}</p>
                            <p><strong>Kondisi Jalan:</strong> {{ $route->road_condition }}</p>
                            <p><strong>Tingkat Kecelakaan:</strong> {{ $route->accident_rate }}</p>
                            <p><strong>Ketersediaan Jalur Sepeda:</strong> {{ $route->bike_lane_availability }}</p>
                            <p><strong>Jumlah Persimpangan:</strong> {{ $route->intersection_count }}</p>
                            <h5>Nilai Normalisasi (dibagi total normalisasi):</h5>
                            <table border="1" style="width: 100%; border-collapse: collapse; margin-bottom: 20px; border: 1px solid #ddd;">
                                <thead>
                                    <tr>
                                        <th style="border: 1px solid #ddd; padding: 8px;">Kriteria</th>
                                        <th style="border: 1px solid #ddd; padding: 8px;">Nilai Normalisasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($route->normalized_values as $key => $value)
                                        <tr>
                                            <td style="border: 1px solid #ddd; padding: 8px;">{{ ucfirst(str_replace('_', ' ', $key)) }}</td>
                                            <td style="border: 1px solid #ddd; padding: 8px;">{{ $value / $totalNormalizedValues[$key] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <h5>Skor Akhir: {{ $route->score }}</h5>
                            <p><strong>Kesamaan Jarak:</strong> {{ $route->distance_similarity }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
