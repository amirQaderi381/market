<?php

namespace App\Models\Market;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Copan extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable=['code','amount','amount_type','discount_ceiling','type','status','start_date','end_date','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
