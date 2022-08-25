<?php

namespace App\Models;

use App\Models\User\Role;
use App\Models\Market\Comment;
use App\Models\Market\Payment;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Ticket\TicketAdmin;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['first_name','last_name','email','password','mobile','profile_photo_path','activation','status','user_type'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function getFullNameAttribute()
    {
      return "{$this->first_name} {$this->last_name}";
    }

    public function ticketAdmin()
    {
        return $this->hasOne(TicketAdmin::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class,'author_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class,'author_id');
    }
}
