<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRouteAlternativesTable extends Migration
{
    public function up()
    {
        Schema::create('route_alternatives', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('distance'); // Jarak Tempuh
            $table->integer('road_condition'); // Kondisi Jalan
            $table->integer('accident_rate'); // Tingkat Kecelakaan
            $table->integer('bike_lane_availability'); // Ketersediaan Jalur Sepeda
            $table->integer('intersection_count'); // Jumlah Persimpangan
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('route_alternatives');
    }
}
