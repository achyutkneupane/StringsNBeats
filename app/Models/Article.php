<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory,SoftDeletes,Sluggable;
    protected $dates = ['deleted_at'];
    protected $guarded = [];
    protected $extends = [
        'writer_flag'
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
}
