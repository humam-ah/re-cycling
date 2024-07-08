<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Penentuan Rute Bersepeda') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('routes.calculate') }}" method="POST">
                        @csrf
                        <label for="distance">Jarak Tempuh yang Diinginkan (m):</label>
                        <input type="number" name="distance" id="distance" step="0.1" required>
                        <button type="submit" style="display: inline-block; background: #50b3a2; color: #fff; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">Hitung</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (isset($distance))
        <div>
            <h2>Hasil Perhitungan Rute</h2>
            <p>Jarak Tempuh yang Diinginkan: {{ $distance }} m</p>
            <table border="1" style="width: 100%; border-collapse: collapse; margin-bottom: 20px; border: 1px solid #ddd;">
                <thead>
                    <tr style="border: 1px solid #ddd;">
                        <th style="border: 1px solid #ddd;">Nama Rute</th>
                        <th style="border: 1px solid #ddd;">Jarak</th>
                        <th style="border: 1px solid #ddd;">Kondisi Jalan</th>
                        <th style="border: 1px solid #ddd;">Tingkat Kecelakaan</th>
                        <th style="border: 1px solid #ddd;">Ketersediaan Jalur Sepeda</th>
                        <th style="border: 1px solid #ddd;">Jumlah Persimpangan</th>
                        <th style="border: 1px solid #ddd;">Skor</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alternatives as $route)
                        <tr style="border: 1px solid #ddd;">
                            <td style="border: 1px solid #ddd;">{{ $route->name }}</td>
                            <td style="border: 1px solid #ddd;">{{ $route->distance }}</td>
                            <td style="border: 1px solid #ddd;">{{ $route->road_condition }}</td>
                            <td style="border: 1px solid #ddd;">{{ $route->accident_rate }}</td>
                            <td style="border: 1px solid #ddd;">{{ $route->bike_lane_availability }}</td>
                            <td style="border: 1px solid #ddd;">{{ $route->intersection_count }}</td>
                            <td style="border: 1px solid #ddd;">{{ $route->score }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
