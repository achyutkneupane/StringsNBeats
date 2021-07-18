<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Article extends Model implements HasMedia
{
    use HasFactory,SoftDeletes,Sluggable,HasMediaTrait;
    protected $dates = ['deleted_at'];
    protected $guarded = [];
    protected $extends = [
        'writer_flag',
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
    public function writer()
    {
        return $this->belongsTo(User::class);
    }
    public function artists()
    {
        return $this->belongsToMany(Artist::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function getWriterFlagAttribute()
    {
        if($this->writer->id == '1' || $this->writer->id == '2' )
        return false;
        else
        return true;
    }
    public function getCoverAttribute()
    {
        return $this->getMedia('cover')->last();
    }
    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('small')
             ->width(150)
             ->height(150);
        $this->addMediaConversion('medium')
             ->width(300)
             ->height(300);
        $this->addMediaConversion('big')
             ->width(800)
             ->height(500);
    }
}
