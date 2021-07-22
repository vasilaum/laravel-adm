<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * hooks.
     */
    public static function boot()
    {
        // Add hash in the password before save //
        static::creating(function (User $user) {
            if (!empty($user->password)) {
                $user->password = Hash::make($user->password);
            }
        });

        // Add hash in the password before update //
        static::updating(function (User $user) {
            if (!empty($user->password)) {
                $user->password = Hash::make($user->password);
            }
        });

        parent::boot();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Get all permissions for the user.
     */
    public function permissions()
    {
        return $this->belongsToMany(SystemPermission::class, 'system_permissions_users');
    }
}