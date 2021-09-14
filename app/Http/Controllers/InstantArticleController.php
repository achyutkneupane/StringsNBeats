<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InstantArticleController extends Controller
{
    public function rss()
    {
        $articles = Article::with('media','category')->orderBy('created_at','DESC')->where(function($query) {
                        $query->where('status','active');
                    })->get();

        $articles->map(function ($each) {
            if (empty($each->guid)) {
                $each->guid = Str::uuid();
            }
        });
        $title = 'Strings N Beats';

        return response()->view('ia', compact('articles','title'))->header('Content-Type', 'application/xml');
    }
}
