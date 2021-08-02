<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ContentImage extends Model
{
    use HasFactory;

    /**
     * hooks.
     */
    public static function boot()
    {
        // Delete image of content storage after delete model //
        static::deleted(function (ContentImage $contentImage) {
            Storage::delete(env('STORAGE_CONTENT_IMAGES_PATH') . $contentImage->path);
        });

        parent::boot();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'path',
        'order',
        'content_id'
    ];

    /**
     * Get the category that owns the content.
     */
    public function content()
    {
        return $this->belongsTo(Content::class);
    }
}