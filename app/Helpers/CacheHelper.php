<?php

namespace App\Helpers;

use App\Models\Article;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

class CacheHelper
{
    public static function updateCache()
    {
        Cache::forget('latest_four');
        Cache::forget('latest_featured');
        Cache::forget('latest_four_news');
        Cache::forget('latest_four_articles');
        Cache::forget('latest_four_releases');
        Cache::rememberForever('latest_four', function () {
            return Article::with('media')->orderBy('created_at','DESC')->where('status','active')->take(4)->get();
        });
        Cache::rememberForever('latest_featured', function () {
            return Article::with('media')->orderBy('created_at','DESC')->where('featured',true)->where('status','active')->take(3)->get();
        });
        Cache::rememberForever('latest_four_news', function () {
            return Article::with('media')->orderBy('created_at','DESC')->where('category_id',1)->where('status','active')->take(4)->get();
        });
        Cache::rememberForever('latest_four_articles', function () {
            return Article::with('media')->orderBy('created_at','DESC')->where('category_id',3)->where('status','active')->take(4)->get();
        });
        Cache::rememberForever('latest_four_releases', function () {
            return Article::with('media')->orderBy('created_at','DESC')->where('category_id',2)->where('status','active')->take(4)->get();
        });
        Article::with('category','writer','tags','artists','media')->orderBy('created_at','DESC')->each(function($article) {
            Cache::forget('article-'.$article->slug);
            Cache::rememberForever('article-'.$article->slug, function () use ($article) {
                return $article;
            });
        });
        Article::orderBy('created_at','DESC')->each(function($article) {
            Cache::forget('latest_five_without_'.$article->id);
            Cache::rememberForever('latest_five_without_'.$article->id, function () use($article) {
                return Article::with('media')->orderBy('created_at','DESC')->where('status','active')->where('id','!=',$article->id)->take(5)->get();
            });
        });
        Article::orderBy('created_at','DESC')->each(function($article) {
            Cache::forget('artist_articles_without_'.$article->id);
            Cache::forget('popular_five_without_'.$article->id);
            Cache::rememberForever('popular_five_without_'.$article->id, function () use($article) {
                return Article::with('media')->orderBy('views','DESC')->where('status','active')->where('id','!=',$article->id)->take(5)->get();
            });
        });
    }
}