<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RouteAlternative;

class RouteController extends Controller
{
    public function index()
    {
        $alternatives = RouteAlternative::all();
        return view('home', compact('alternatives'));
    }

    public function calculate(Request $request)
    {
        $distance = $request->input('distance');
        $alternatives = RouteAlternative::all();

        // Bobot kriteria (sudah berdasar perhitungan matriks perbandingan)
        $weights = [
            'distance' => 0.462385053,
            'road_condition' => 0.195153992,
            'accident_rate' => 0.195153992,
            'bike_lane_availability' => 0.073653481,
            'intersection_count' => 0.073653481,
        ];

        // Inisialisasi nilai maksimum dan minimum untuk normalisasi
        $maxValues = [
            'road_condition' => $alternatives->max('road_condition'),
            'bike_lane_availability' => $alternatives->max('bike_lane_availability'),
        ];

        $minValues = [
            'distance' => $alternatives->min('distance'),
            'accident_rate' => $alternatives->min('accident_rate'),
            'intersection_count' => $alternatives->min('intersection_count'),
        ];

        // Variabel untuk menyimpan total nilai normalisasi per kriteria
        $totalNormalizedValues = [
            'distance' => 0,
            'road_condition' => 0,
            'accident_rate' => 0,
            'bike_lane_availability' => 0,
            'intersection_count' => 0,
        ];

        // Normalisasi nilai setiap kriteria
        foreach ($alternatives as $route) {
            $normalizedValues = [
                'distance' => $minValues['distance'] / $route->distance, // Cost
                'road_condition' => $route->road_condition / $maxValues['road_condition'], // Benefit
                'accident_rate' => $minValues['accident_rate'] / $route->accident_rate, // Cost
                'bike_lane_availability' => $route->bike_lane_availability / $maxValues['bike_lane_availability'], // Benefit
                'intersection_count' => $minValues['intersection_count'] / $route->intersection_count, // Cost
            ];  

           // Jumlahkan nilai normalisasi untuk setiap kriteria
            foreach ($normalizedValues as $key => $value) {
                $totalNormalizedValues[$key] += $value;
            }

            // Simpan nilai normalisasi sementara pada model
            $route->normalized_values = $normalizedValues;
        }

        // Hitung skor akhir dengan membagi nilai normalisasi dengan total normalisasi
        foreach ($alternatives as $route) {
            $route->score = 0;
            foreach ($route->normalized_values as $key => $value) {
                $normalizedValue = $value / $totalNormalizedValues[$key];
                $route->score += $normalizedValue * $weights[$key];
            }

            // Hitung kesamaan jarak
            $route->distance_similarity = abs($route->distance - $distance);
        }

        // Urutkan alternatif pertama berdasarkan kesamaan jarak, kemudian skor akhir
        $alternatives = $alternatives->sortBy(function ($route) {
            return [$route->distance_similarity, -$route->score];
        });

        // Ambil hanya 5 alternatif paling mirip
        $alternatives = $alternatives->take(5);

        return view('home', compact('alternatives', 'distance'));
    }


    public function create()
    {
        return view('routes.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'distance' => 'required|numeric',
            'road_condition' => 'required|numeric',
            'accident_rate' => 'required|numeric',
            'bike_lane_availability' => 'required|numeric',
            'intersection_count' => 'required|numeric',
        ]);

        // Simpan data alternatif rute ke database
        RouteAlternative::create([
            'name' => $request->input('name'),
            'distance' => $request->input('distance'),
            'road_condition' => $request->input('road_condition'),
            'accident_rate' => $request->input('accident_rate'),
            'bike_lane_availability' => $request->input('bike_lane_availability'),
            'intersection_count' => $request->input('intersection_count'),
        ]);

        return redirect()->route('home')->with('success', 'Alternatif rute berhasil ditambahkan!');
    }
}