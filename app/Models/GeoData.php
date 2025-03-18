<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeoData extends Model
{
    use HasFactory;

    protected $table = 'geodata';

    protected $fillable = ['name', 'geojson'];

    protected $casts = [
        'data' => 'json',
    ];
}
