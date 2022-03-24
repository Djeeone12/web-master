<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class SubCategory extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia;

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public $casts = [
        'video_urls' => 'array',
        'measures' => 'array',
    ];

    public function getImage()
    {
        if ($this->logo !== null && $this->logo !== '')
        {
            return 'https://tecnotanques.s3-us-east-2.amazonaws.com/' . $this->logo;
        } else
        {
            return '/img/tecnotanques/NotFound.png';
        }

    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(350)
            ->height(350);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('main')->singleFile();
        $this->addMediaCollection('sub_category_images');
    }
}
