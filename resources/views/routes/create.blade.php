<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Alternatif Rute') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('routes.store') }}" method="POST">
                        @csrf

                        <!-- Session Keterangan -->
                        <div style="margin-bottom: 20px; border: 1px solid #ddd; padding: 10px; border-radius: 5px;">
                            <h3 style="margin-bottom: 10px;">Keterangan Kriteria:</h3>
                            <ul>
                                <li><strong>Kondisi Jalan:</strong> 1 = sangat buruk, 2 = buruk, 3 = sedang, 4 = baik, 5 = sangat baik</li>
                                <li><strong>Tingkat Kecelakaan:</strong> 1 = sangat rendah, 2 = rendah, 3 = sedang, 4 = tinggi, 5 = sangat tinggi</li>
                                <li><strong>Ketersediaan Jalur Sepeda:</strong> 1 = tidak tersedia, 2 = tersedia</li>
                            </ul>
                        </div>

                        <div>
                            <label for="name">Nama Rute:</label>
                            <input type="text" name="name" id="name" required>
                        </div>
                        <div>
                            <label for="distance">Jarak (m):</label>
                            <input type="number" name="distance" id="distance" step="1" required>
                        </div>
                        <div>
                            <label for="road_condition">Kondisi Jalan (1-5):</label>
                            <input type="number" name="road_condition" id="road_condition" min="1" max="5" required>
                        </div>
                        <div>
                            <label for="accident_rate">Tingkat Kecelakaan (1-5):</label>
                            <input type="number" name="accident_rate" id="accident_rate" min="1" max="5" required>
                        </div>
                        <div>
                            <label for="bike_lane_availability">Ketersediaan Jalur Sepeda (1=tidak ada, 2=ada):</label>
                            <input type="number" name="bike_lane_availability" id="bike_lane_availability" min="1" max="2" required>
                        </div>
                        <div>
                            <label for="intersection_count">Jumlah Persimpangan:</label>
                            <input type="number" name="intersection_count" id="intersection_count" required>
                        </div>
                        <button type="submit" style="display: inline-block; background: #50b3a2; color: #fff; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">Tambah Rute</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>