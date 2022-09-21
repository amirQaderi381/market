<?php

namespace App\Models;

use App\Models\city;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = ['id'];

    public function city()
    {
        return $this->belongsTo(city::class);
    }
}
