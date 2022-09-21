<?php

namespace App\Models;

use App\Models\city;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Province extends Model
{
    use HasFactory;

    public function cities()
    {
        return $this->hasMany(city::class);
    }
}
