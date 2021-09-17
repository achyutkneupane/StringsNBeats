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
        $articles->map(function($article) {
            $img = preg_replace('/<img(.+?)>/m','<figure><img$1></figure>',$article->content);
            $iframe = preg_replace('/<iframe(.+?)>/m','<figure class="op-interactive"><iframe$1>',$img);
            $article->content = preg_replace('/<\/iframe>/m',"</iframe></figure>",$iframe);
        });
        dd($articles);
        return response()->view('ia', compact('articles','title'))->header('Content-Type', 'application/xml');
    }
}
