<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemPermission extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'url_action',
        'http_method',
        'system_module_id'
    ];

    /**
     * Get all users for the permission.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'system_permissions_users');
    }
}