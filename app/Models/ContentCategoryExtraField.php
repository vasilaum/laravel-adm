<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentCategoryExtraField extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'type',
        'category_id'
    ];

    /**
     * Get the category that owns the extra field.
     */
    public function category()
    {
        return $this->belongsTo(ContentCategory::class);
    }

}