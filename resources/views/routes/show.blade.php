<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Rute') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('success'))
                        <div style="color: green; margin-bottom: 20px;">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Session Keterangan -->
                    <div style="margin-bottom: 20px; border: 1px solid #ddd; padding: 10px; border-radius: 5px;">
                        <h3 style="margin-bottom: 10px;">Keterangan Kriteria:</h3>
                        <ul>
                            <li><strong>Kondisi Jalan:</strong> 1 = sangat buruk, 2 = buruk, 3 = sedang, 4 = baik, 5 = sangat baik</li>
                            <li><strong>Tingkat Kecelakaan:</strong> 1 = sangat rendah, 2 = rendah, 3 = sedang, 4 = tinggi, 5 = sangat tinggi</li>
                            <li><strong>Ketersediaan Jalur Sepeda:</strong> 1 = tidak tersedia, 2 = tersedia</li>
                        </ul>
                    </div>

                    <table border="1" style="width: 100%; border-collapse: collapse; margin-bottom: 20px; border: 1px solid #ddd;">
                        <thead>
                            <tr style="border: 1px solid #ddd;">
                                <th style="border: 1px solid #ddd;">Nama Rute</th>
                                <th style="border: 1px solid #ddd;">Jarak (m)</th>
                                <th style="border: 1px solid #ddd;">Kondisi Jalan</th>
                                <th style="border: 1px solid #ddd;">Tingkat Kecelakaan</th>
                                <th style="border: 1px solid #ddd;">Ketersediaan Jalur Sepeda</th>
                                <th style="border: 1px solid #ddd;">Jumlah Persimpangan</th>
                                <th style="border: 1px solid #ddd;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($routes as $route)
                                <tr style="border: 1px solid #ddd;">
                                    <td style="border: 1px solid #ddd;">{{ $route->name }}</td>
                                    <td style="border: 1px solid #ddd; text-align: right;">{{ $route->distance }}</td>
                                    <td style="border: 1px solid #ddd; text-align: right;">{{ $route->road_condition }}</td>
                                    <td style="border: 1px solid #ddd; text-align: right;">{{ $route->accident_rate }}</td>
                                    <td style="border: 1px solid #ddd; text-align: right;">{{ $route->bike_lane_availability }}</td>
                                    <td style="border: 1px solid #ddd; text-align: right;">{{ $route->intersection_count }}</td>
                                    <td style="border: 1px solid #ddd; text-align: center;">
                                        <a href="{{ route('routes.edit', $route->id) }}" style="display: inline-block; background: #50b3a2; color: #fff; padding: 5px 10px; border: none; border-radius: 5px; text-decoration: none;">Edit</a>
                                        <form action="{{ route('routes.destroy', $route->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="display: inline-block; background: #e3342f; color: #fff; padding: 5px 10px; border: none; border-radius: 5px; cursor: pointer;">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
