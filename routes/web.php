<?php

use App\Http\Livewire\Admin\Articles\Add as AddArticle;
use App\Http\Livewire\Admin\AddYoutube;
use App\Http\Livewire\Admin\Articles\ListArticles;
use App\Http\Livewire\Admin\Articles\EditArticle;
use App\Http\Livewire\Admin\Artist\AddArtist;
use App\Http\Livewire\Admin\Artist\ListArtists;
use App\Http\Livewire\Admin\Dashboard;
use App\Http\Livewire\Admin\Song\EditSong;
use App\Http\Livewire\Admin\Song\ListSongs;
use App\Http\Livewire\Pages\AboutUs;
use App\Http\Livewire\Pages\ArticleView;
use App\Http\Livewire\Pages\CategoryArticles;
use App\Http\Livewire\Pages\ContactUs;
use App\Http\Livewire\Pages\LandingPage;
use App\Http\Livewire\Pages\ListSongs as PagesListSongs;
use App\Http\Livewire\Pages\Login;
use App\Http\Livewire\Pages\SongView;
use App\Models\Article;
use App\Models\Category;
use App\Models\Song;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use MadWeb\Robots\Robots;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::feeds();

// Route::get('/spatiegenerate',function()
//     {
//         foreach(Article::get() as $article) {
//             $article->addMediaFromUrl('https://dummyimage.com/3999x3999/000000/00CED1?text='.$article->slug)
//                     ->toMediaCollection('cover');
//         }
//         dd(Article::find(11)->cover->getUrl('big'));
//     });

Route::get('/',LandingPage::class)->name('homepage');

Route::prefix('/sitemap')->group(function() {
    Route::get('/',function() {
        // Main Sitemap

        $sitemap = App::make("sitemap");
        $sitemap->setCache('laravel.sitemap', 3600);
        $sitemap->addSitemap(route('staticsSitemap'),Carbon::now());
        $sitemap->addSitemap(route('articlesSitemap'),Carbon::now());
        $sitemap->addSitemap(route('newsSitemap'),Carbon::now());
        $sitemap->addSitemap(route('categoriesSitemap'),Carbon::now());
        $sitemap->addSitemap(route('songsSitemap'),Carbon::now());
        return $sitemap->render('sitemapindex');
    })->name('mainSitemap');
    Route::get('/categories',function() {
        // Categories Sitemap
        $sitemap_categories = App::make("sitemap");
        $sitemap_categories->setCache('laravel.sitemap.categories', 3600);
        $image = [
            [
                'url' => asset('statics/ogimage.jpg'),
                'title' => 'All Articles - '.config('app.name'),
                'caption' => "Strings N’ Beats is the primary destination for Nepali music-related matters and stories surrounding it all. Click here to list all the articles/news written in Strings N' Beats."
            ],
        ];
        $sitemap_categories->add(route('viewCategory','all'), now(), 0.7, 'hourly',$image,'All Articles - '.config('app.name'));
        $image = [
            [
                'url' => asset('statics/ogimage.jpg'),
                'title' => 'Songs - '.config('app.name'),
                'caption' => "Strings N’ Beats is the primary destination for Nepali music-related matters and stories surrounding it all. Click here to see the songs listed in Strings N' Beats."
            ],
        ];
        $sitemap_categories->add(route('listSongs'), now(), 0.9, 'hourly',$image,'Songs - '.config('app.name'));
        $image = [
            [
                'url' => asset('statics/ogimage.jpg'),
                'title' => 'All Songs - '.config('app.name'),
                'caption' => "Strings N’ Beats is the primary destination for Nepali music-related matters and stories surrounding it all. Click here to see all the songs listed in Strings N' Beats."
            ],
        ];
        $sitemap_categories->add(route('listAllSongs','all'), now(), 0.7, 'hourly',$image,'All Songs - '.config('app.name'));
        Category::get()->each(function (Category $category) use($sitemap_categories) {
            if($category->deleted_at == NULL) {
                $image = [
                    [
                        'url' => asset('statics/ogimage.jpg'),
                        'title' => $category->title.' - '.config('app.name'),
                        'caption' => "Strings N’ Beats is the primary destination for Nepali music-related matters and stories surrounding it all. Click here to list all the ".strtolower($category->title)>" written in Strings N' Beats"
                    ],
                ];
                $sitemap_categories->add(route('viewCategory',$category->slug), $category->updated_at, 0.9, 'hourly',$image,$category->title.' - '.config('app.name'));
            }
        });
        return $sitemap_categories->render('xml');
    })->name('categoriesSitemap');
    Route::get('/songs',function() {
        // Categories Sitemap
        $sitemap_songs = App::make("sitemap");
        $sitemap_songs->setCache('laravel.sitemap.songs', 3600);
        
        Song::get()->each(function (Song $song) use($sitemap_songs) {
            if($song->published_at != NULL) {
                $image = [
                    [
                        'url' => $song->image->getUrl(),
                        'title' => $song->title.' - '.$song->artists->first()->name.' - '.config('app.name'),
                        'caption' => $song->description
                    ],
                ];
                $sitemap_songs->add(route('viewSong',$song->slug), Carbon::parse($song->released_at), 0.8, 'hourly',$image,$song->title.' - '.config('app.name'));
            }
        });
        return $sitemap_songs->render('xml');
    })->name('songsSitemap');
    Route::get('/news',function() {

        // News Sitemap
        $sitemap_news = App::make("sitemap");
        $sitemap_news->setCache('laravel.sitemap.articles', 3600);
        Article::get()->each(function (Article $article) use($sitemap_news) {
            $image = [
                [
                    'url' => $article->cover->getUrl(),
                    'title' => $article->title,
                    'caption' => $article->description ? $article->description : NULL
                ],
            ];
            $googleNews = [
                'sitename' => 'Strings N\' Beats',
                'language' => 'en',
                'publication_date' => $article->created_at,
            ];
            if($article->status == 'active') {
                $sitemap_news->add(route('viewArticle',$article->slug), $article->updated_at, 0.9, 'weekly',$image,$article->title,NULL,NULL,$googleNews,NULL);
            }
        });
        return $sitemap_news->render('google-news');
    })->name('newsSitemap');
    Route::get('/statics',function() {
        // Static Sitemap
        $sitemap_statics = App::make("sitemap");
        $sitemap_statics->setCache('laravel.sitemap.statics', 10);
        $image = [
            [
                'url' => asset('statics/ogimage.jpg'),
                'title' => config('app.name')." || Primary Destination for Nepali Music Contents",
                'caption' => "Strings N’ Beats is the primary destination for Nepali music-related matters and stories surrounding it all. We keep you updated on worldwide exclusive news, videos, events, and more."
            ],
        ];
        $sitemap_statics->add(route('homepage'),Carbon::create('2021', '6', '6'), 1, 'hourly',$image,config('app.name'));

        $contactimage = [
            [
                'url' => asset('statics/ogimage.jpg'),
                'title' => 'Contact Us - '.config('app.name'),
                'caption' => "Strings N’ Beats is the primary destination for Nepali music-related matters and stories surrounding it all. Click here to contact us."
            ],
        ];
        $sitemap_statics->add(route('contactUs'),Carbon::create('2021', '6', '6'), 0.3, 'yearly',$contactimage);
        return $sitemap_statics->render('xml');
    })->name('staticsSitemap');
    Route::get('/articles',function() {
        // Articles Sitemap
        $sitemap_articles = App::make("sitemap");
        $sitemap_articles->setCache('laravel.sitemap.articles', 3600);
        Article::get()->each(function (Article $article) use($sitemap_articles) {
            $image = [
                [
                    'url' => $article->cover->getUrl(),
                    'title' => $article->title,
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
                $sitemap_articles->add(route('viewArticle',$article->slug), $article->updated_at, 0.9, 'weekly',$image,$article->title,NULL,NULL,$googleNews,NULL);
            }
        });
        return $sitemap_articles->render('xml');
    })->name('articlesSitemap');
});

Route::get('robots.txt', function(Robots $robots) {
    $robots->addUserAgent('*');
    if ($robots->shouldIndex()) {
        $robots->addDisallow('/panel');
    } else {
        $robots->addDisallow('/');
    }
    return response($robots->generate(), 200, ['Content-Type' => 'text/plain']);
});
Route::prefix('/panel')->middleware('auth')->group(function() {
    Route::get('/',Dashboard::class)->name('adminDashboard');
    Route::get('/youtube', AddYoutube::class)->middleware('auth');
    
    Route::get('/articles',ListArticles::class)->name('adminArticles');
    Route::get('/articles/add',AddArticle::class)->name('adminAddArticles');
    Route::get('/articles/edit/{articleId}',EditArticle::class)->name('adminEditArticles');

    Route::get('/artists', ListArtists::class)->name('adminArtists');
    Route::get('/artists/add', AddArtist::class)->name('adminAddArtist');
    Route::get('/artists/edit/{artistId}', AddArtist::class)->name('adminEditArtist');

    Route::get('/songs', ListSongs::class)->name('adminSongs');
    Route::get('/songs/edit/{songId}', EditSong::class)->name('adminEditSong');
});

Route::get('/login',Login::class)->name('login');
Route::get('/about-us',AboutUs::class)->name('aboutUs');
Route::get('/contact-us',ContactUs::class)->name('contactUs');
Route::get('/category/{slug}',CategoryArticles::class)->name('viewCategory');
Route::get('/song/{slug}',SongView::class)->name('viewSong');
Route::get('/songs',PagesListSongs::class)->name('listSongs');
Route::get('/songs/{all}',PagesListSongs::class)->name('listAllSongs');
Route::get('/{slug}',ArticleView::class)->name('viewArticle');

// Auth::routes();



    // Route::get('/schema',function() {
    //     $article = Article::find(8);
    //     $localBusiness = Schema::article()
    //                             ->mainEntityOfPage(Schema::webSite()->url(route('homepage')))
    //                             ->url(route('viewArticle',$article->slug))
    //                             ->headline($article->title)
    //                             ->image($article->cover->getUrl())
    //                             ->datePublished($article->created_at)
    //                             ->dateModified($article->updated_at)
    //                             ->commentCount($article->comments->count())
    //                             ->publisher(Schema::organization()->name('Strings N\' Beats')->email('info@stringsnbeats.net')->logo(Schema::imageObject()->url(asset('statics/logo-small.png'))))
    //                             ->author($article->writer_flag ? Schema::person()->name($article->writer->name) : Schema::organization()->name('Strings N\' Beats')->email('info@stringsnbeats.net')->logo(Schema::imageObject()->url(asset('statics/logo-small.png'))))
    //                             ->sameAs(array('https://www.facebook.com/StringsNBeatsNepal/','https://www.instagram.com/stringsnbeats/','https://www.twitter.com/strings_beats'));
    
    //     return $localBusiness->toArray();
    // });
    
    