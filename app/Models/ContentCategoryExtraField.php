<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentCategoryExtraField extends Model
{
    use HasFactory;

    /**
     * hooks.
     */
    public static function boot()
    {
        static::retrieved(function (ContentCategoryExtraField $extraField) {
            // Only convert field in json if the request route uri came from content form //
            if (!empty($extraField->options) && request()->route()->uri() === "contents/form/{id?}") {
                $extraField->options = json_decode($extraField->options);
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
        'field_id',
        'placeholder',
        'label',
        'mask',
        'options',
        'type',
        'category_id',

    ];

    /**
     * Get the category that owns the extra field.
     */
    public function category()
    {
        return $this->belongsTo(ContentCategory::class);
    }

}