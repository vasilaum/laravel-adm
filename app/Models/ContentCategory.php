<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * Get all contents for category
     */
    public function contents()
    {
        return $this->hasMany(Content::class, 'category_id');
    }

    /**
     * Get all extra fields for category
     */
    public function extraFields()
    {
        return $this->hasMany(ContentCategoryExtraField::class, 'category_id');
    }
}