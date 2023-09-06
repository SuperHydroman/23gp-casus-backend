<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $hidden = ['driver_id', 'created_at', 'updated_at'];
    protected $fillable = ['driver_id', 'sector_1', 'sector_2', 'sector_3', 'lap_total'];

    public function driver() {
        return $this->hasOne(Driver::class, 'id', 'driver_id');
    }
}
