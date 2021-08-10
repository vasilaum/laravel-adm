<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentExtraField extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'value',
        'content_id'
    ];

    /**
     * Get the content that owns the extra field.
     */
    public function content()
    {
        return $this->belongsTo(Content::class);
    }

}