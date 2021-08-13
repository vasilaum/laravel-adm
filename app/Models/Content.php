<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Content extends Model
{
    use HasFactory;

    /**
     * hooks.
     */
    public static function boot()
    {
        // Delete image of content storage after delete model //
        static::deleting(function (Content $content) {
            $images = ContentImage::where('content_id', $content->id)->get();

            foreach($images as $image) {
                Storage::delete(env('STORAGE_CONTENT_IMAGES_PATH') . $image->path);
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
        'data',
        'date',
        'category_id'
    ];

    /**
     * Get the category that owns the content.
     */
    public function category()
    {
        return $this->belongsTo(ContentCategory::class);
    }

    /**
     * Get all images for content
     */
    public function images()
    {
        return $this->hasMany(ContentImage::class);
    }

    /**
     * Get all extra fields for content
     */
    public function extraFields()
    {
        return $this->hasMany(ContentExtraField::class);
    }
}