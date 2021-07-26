<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

class SitemapGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generating Sitemap';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Static Sitemap
        $sitemap_statics = App::make("sitemap");
        $sitemap_statics->setCache('laravel.sitemap.statics', 10);
        $sitemap_statics->add(route('homepage'),Carbon::create('2021', '6', '6'), 1, 'daily');
        $sitemap_statics->add(route('contactUs'),Carbon::create('2021', '6', '6'), 0.3, 'yearly');
        $sitemap_statics->store('xml','sitemap-statics');

        // Articles Sitemap
        $sitemap_articles = App::make("sitemap");
        $sitemap_articles->setCache('laravel.sitemap.articles', 3600);
        Article::get()->each(function (Article $article) use($sitemap_articles) {
            $image = [
                [
                    'url' => $article->cover->getUrl(),
                    'title' => $article->title.' - '.config('app.name'),
                    'caption' => $article->description ? $article->description : NULL
                ],
            ];
            $googleNews = [
                'sitename' => config('app.name'),
                'language' => 'en',
                'publication_date' => '2016-01-03',
                'access'           => 'Subscription',
            ];
            if($article->status == 'active') {
                $sitemap_articles->add(route('viewArticle',$article->slug), $article->updated_at, 0.9, 'weekly',$image,'Kando',NULL,NULL,$googleNews,NULL);
            }
        });
        $sitemap_articles->render('xml','sitemap-articles');

        // News Sitemap
        $sitemap_news = App::make("sitemap");
        $sitemap_news->setCache('laravel.sitemap.articles', 3600);
        Article::get()->each(function (Article $article) use($sitemap_news) {
            $image = [
                [
                    'url' => $article->cover->getUrl(),
                    'title' => $article->title.' - '.config('app.name'),
                    'caption' => $article->description ? $article->description : NULL
                ],
            ];
            $googleNews = [
                'sitename' => 'Strings N\' Beats',
                'language' => 'en',
                'publication_date' => $article->created_at,
            ];
            if($article->status == 'active') {
                $sitemap_news->add(route('viewArticle',$article->slug), $article->updated_at, 0.9, 'weekly',$image,$article->title.' - '.config('app.name'),NULL,NULL,$googleNews,NULL);
            }
        });
        $sitemap_news->store('google-news','sitemap-news');

        // Categories Sitemap
        $sitemap_categories = App::make("sitemap");
        $sitemap_categories->setCache('laravel.sitemap.categories', 3600);
        Category::get()->each(function (Category $category) use($sitemap_categories) {
            if($category->deleted_at == NULL) {
                $sitemap_categories->add(route('viewCategory',$category->slug), $category->updated_at, 0.5, 'daily');
            }
        });
        $sitemap_categories->store('xml','sitemap-categories');

        // Main Sitemap

        $sitemap = App::make("sitemap");
        $sitemap->setCache('laravel.sitemap', 3600);
        $sitemap->addSitemap(URL::to('sitemap-statics.xml'),Carbon::now());
        $sitemap->addSitemap(URL::to('sitemap-articles.xml'),Carbon::now());
        $sitemap->addSitemap(URL::to('sitemap-news.xml'),Carbon::now());
        $sitemap->addSitemap(URL::to('sitemap-categories.xml'),Carbon::now());
        $sitemap->store('sitemapindex','sitemap');
    }
}
