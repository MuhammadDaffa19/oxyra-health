<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavoriteCity extends Model
{
    protected $fillable = [
        'user_id', 'city_name', 'state', 'country', 'country_code', 'flag', 'lat', 'lng'
    ];
}
