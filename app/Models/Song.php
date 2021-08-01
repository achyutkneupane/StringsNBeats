<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Song extends Model implements HasMedia
{
    use HasFactory,Sluggable,HasMediaTrait;
    protected $guarded = [];
    protected $extends = [
        'cover'
    ];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    public function album()
    {
        return $this->belongsTo(Album::class);
    }
    public function artists()
    {
        return $this->belongsToMany(Artist::class);
    }
    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }
    public function getImageAttribute()
    {
        return $this->getMedia('image')->last();
    }
    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('small')
            //  ->format(Manipulations::FORMAT_WEBP)
             ->width(100)
             ->height(100)
             ->nonQueued();
        $this->addMediaConversion('medium')
            //  ->format(Manipulations::FORMAT_WEBP)
             ->width(300)
             ->height(300)
             ->nonQueued();
        $this->addMediaConversion('big')
            //  ->format(Manipulations::FORMAT_WEBP)
             ->width(800)
             ->height(500)
             ->nonQueued();
    }
}
