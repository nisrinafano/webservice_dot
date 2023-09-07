<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class city extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'city';

    protected $fillable = [
        'city_id',
        'province_id',
        'province',
        'type',
        'city_name',
        'postal_code'
    ];
}
