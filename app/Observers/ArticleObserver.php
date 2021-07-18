<?php

namespace App\Observers;

use App\Models\Article;
use Illuminate\Support\Facades\Cache;

class ArticleObserver
{
    /**
     * Handle the Article "created" event.
     *
     * @param  \App\Models\Article  $article
     * @return void
     */
    public function created(Article $article)
    {
        Cache::forget('latests_four');
        Cache::forget('latests_featured');
        Cache::forget('latests_four_news');
        Cache::forget('latests_four_articles');
        Cache::forget('latests_four_releases');
        Cache::rememberForever('latests_four', function () {
            return Article::with('media')->orderBy('created_at','DESC')->where('status','active')->take(4)->get();
        });
        Cache::rememberForever('latests_featured', function () {
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
            Cache::forget('latest_six_without_'.$article->id);
            Cache::rememberForever('latest_six_without_'.$article->id, function () use($article) {
                return Article::with('media')->orderBy('created_at','DESC')->where('status','active')->where('id','!=',$article->id)->take(6)->get();
            });
        });
    }

    /**
     * Handle the Article "updated" event.
     *
     * @param  \App\Models\Article  $article
     * @return void
     */
    public function updated(Article $article)
    {
        Cache::forget('latests_four');
        Cache::forget('latests_featured');
        Cache::forget('latests_four_news');
        Cache::forget('latests_four_articles');
        Cache::forget('latests_four_releases');
        Cache::rememberForever('latests_four', function () {
            return Article::with('media')->orderBy('created_at','DESC')->where('status','active')->take(4)->get();
        });
        Cache::rememberForever('latests_featured', function () {
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
            Cache::forget('latest_six_without_'.$article->id);
            Cache::rememberForever('latest_six_without_'.$article->id, function () use($article) {
                return Article::with('media')->orderBy('created_at','DESC')->where('status','active')->where('id','!=',$article->id)->take(6)->get();
            });
        });
    }

    /**
     * Handle the Article "deleted" event.
     *
     * @param  \App\Models\Article  $article
     * @return void
     */
    public function deleted(Article $article)
    {
        //
    }

    /**
     * Handle the Article "restored" event.
     *
     * @param  \App\Models\Article  $article
     * @return void
     */
    public function restored(Article $article)
    {
        //
    }

    /**
     * Handle the Article "force deleted" event.
     *
     * @param  \App\Models\Article  $article
     * @return void
     */
    public function forceDeleted(Article $article)
    {
        //
    }
}
