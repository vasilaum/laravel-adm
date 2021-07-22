<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'data',
        'category_id'
    ];

    /**
     * Get the category that owns the content.
     */
    public function category()
    {
        return $this->belongsTo(ContentCategory::class);
    }
}