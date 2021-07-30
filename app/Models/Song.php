<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory,Sluggable;
    protected $guarded = [];
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
}
