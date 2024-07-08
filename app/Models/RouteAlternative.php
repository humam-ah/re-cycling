<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RouteAlternative extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'distance', 'road_condition', 'accident_rate', 'bike_lane_availability', 'intersection_count'
    ];
}
