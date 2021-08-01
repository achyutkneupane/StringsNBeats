<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use Illuminate\Support\Str;

class Article extends Model implements HasMedia, Feedable
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
        return $this->belongsToMany(Artist::class,'article_artist','article_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function songs()
    {
        return $this->belongsToMany(Song::class,'article_song','article_id');
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
             ->format(Manipulations::FORMAT_WEBP)
             ->width(100)
             ->height(100)
             ->nonQueued();
        $this->addMediaConversion('medium')
             ->format(Manipulations::FORMAT_WEBP)
             ->width(300)
             ->height(300)
             ->nonQueued();
        $this->addMediaConversion('big')
             ->format(Manipulations::FORMAT_WEBP)
             ->width(800)
             ->height(500)
             ->nonQueued();
    }
    public function toFeedItem(): FeedItem
    {
        return FeedItem::create()
            ->id($this->slug)
            ->title($this->title)
            ->summary($this->description ? $this->description : Str::limit(strip_tags($this->content),200))
            ->updated($this->created_at)
            ->link(route('viewArticle',$this->slug))
            ->author('Strings N\' Beats')
            ->category($this->category->title);
    }
    public static function getFeedNews()
    {
        return Article::with('category')->where('category_id',1)->where('status','active')->get();
    }
    public static function getFeedNewReleases()
    {
        return Article::with('category')->where('category_id',2)->where('status','active')->get();
    }
    public static function getFeedArticles()
    {
        return Article::with('category')->where('category_id',3)->where('status','active')->get();
    }
}
