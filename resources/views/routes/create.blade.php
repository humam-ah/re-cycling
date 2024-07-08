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