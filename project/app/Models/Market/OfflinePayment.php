<?php

namespace App\Models\Market;

use App\Models\Market\Payment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OfflinePayment extends Model
{
    use HasFactory,SoftDeletes;

    // public function payment()
    // {
    //     return $this->morphMany(Payment::class,'paymentable');
    // }

    public function payment()
    {
        return $this->morphTo(Payment::class,'paymentable');
    }
}
