<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentCategoryExtraField extends Model
{
    use HasFactory;

    public static function boot()
    {
        static::retrieved(function (ContentCategoryExtraField $extraField) {
            // Only convert field in json if the request route uri came from content form //
            if (!empty($extraField->options) && request()->route()->uri() === "contents/form/{id?}") {
                $extraField->options = json_decode($extraField->options);
            }
        });

        // Delete content extra fields too //
        static::deleting(function (ContentCategoryExtraField $extraField) {
            $categoryId                     = $extraField->category_id;
            $contentBelongingCategory       = Content::where('category_id', $categoryId)->get();
            $extraFieldsIdsBeloningContent  = [];

            if(count($contentBelongingCategory) > 0) {
                foreach($contentBelongingCategory as $content) {
                    array_push(
                        $extraFieldsIdsBeloningContent,
                        ContentExtraField::where('content_id', $content->id)->where('name', $extraField->name)->first()->id
                    );
                }
            }

            if(count($extraFieldsIdsBeloningContent) > 0) {
                ContentExtraField::destroy($extraFieldsIdsBeloningContent);
            }
        });

        parent::boot();
    }

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