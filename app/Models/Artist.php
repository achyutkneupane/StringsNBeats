<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artist extends Model
{
    use HasFactory,SoftDeletes,Sluggable;
    protected $dates = ['deleted_at'];
    protected $guarded = [];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }
    public function albums()
    {
        return $this->hasMany(Album::class);
    }
    public function songs()
    {
        return $this->hasMany(Song::class);
    }
}
