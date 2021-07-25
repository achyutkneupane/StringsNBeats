<?php

use App\Http\Livewire\Admin\AddArticle;
use App\Http\Livewire\Admin\AddYoutube;
use App\Http\Livewire\Admin\Articles;
use App\Http\Livewire\Admin\EditArticle;
use App\Http\Livewire\Admin\Dashboard;
use App\Http\Livewire\Pages\AboutUs;
use App\Http\Livewire\Pages\ArticleView;
use App\Http\Livewire\Pages\CategoryArticles;
use App\Http\Livewire\Pages\ContactUs;
use App\Http\Livewire\Pages\LandingPage;
use App\Http\Livewire\Pages\Login;
use App\Models\Article;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use MadWeb\Robots\Robots;
use Spatie\SchemaOrg\Schema;
use Watson\Sitemap\Facades\Sitemap;

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

Route::get('/',LandingPage::class)->name('homepage');

// Route::get('/sitemap.xml',function() {
//     $tag = Sitemap::addTag(route('homepage'),Carbon::create('2021', '6', '6'),'daily',1);
//     $tag->addImage(asset('statics/ogimage.jpg'), "Strings N’ Beats is the primary destination for music related matter and stories surrounding it all. We keep you updated on worldwide exclusive news, videos, events and more." ,NULL,config('app.name'));
//     $tag = Sitemap::addTag(route('contactUs'),Carbon::create('2021', '6', '6'),'yearly',0.9);
//     $tag->addImage(asset('statics/ogimage.jpg'), "Strings N’ Beats is the primary destination for music related matter and stories surrounding it all. We keep you updated on worldwide exclusive news, videos, events and more." ,NULL,"Contact Us - ".config('app.name'));
//     Article::all()->each(function (Article $article) {
//         if($article->status == 'active') {
//             $tag = Sitemap::addTag(route('viewArticle',$article->slug),$article->updated_at,'daily',0.8);
//             $tag->addImage($article->cover->getUrl(), $article->description ? $article->description : NULL,NULL,$article->title.' - '.config('app.name'));
//         }
//     });
//     Category::all()->each(function(Category $category) {
//         $tag = Sitemap::addTag(route('viewCategory',$category->slug),$category->updated_at,'daily',0.8);
//         $tag->addImage(asset('statics/ogimage.jpg'), "Strings N’ Beats is the primary destination for Nepali Music related matter and stories surrounding it all. Check this page to get informations about the ".$category->title." in Nepali Music." ,NULL,config('app.name'));
//     });
//     return Sitemap::render();
// })->name('sitemap');


Route::get('robots.txt', function(Robots $robots) {
    $robots->addUserAgent('*');
    if ($robots->shouldIndex()) {
        $robots->addDisallow('/panel');
        $robots->addSitemap(route('sitemap'));
    } else {
        $robots->addDisallow('/');
    }
    return response($robots->generate(), 200, ['Content-Type' => 'text/plain']);
});
Route::prefix('/panel')->middleware('auth')->group(function() {
    Route::get('/',Dashboard::class)->name('adminDashboard');
    Route::get('/youtube', AddYoutube::class)->middleware('auth');
    Route::get('/articles',Articles::class)->name('adminArticles');
    Route::get('/articles/add',AddArticle::class)->name('adminAddArticles');
    Route::get('/articles/edit/{articleId}',EditArticle::class)->name('adminEditArticles');
});

Route::get('/login',Login::class)->name('login');
Route::get('/about-us',AboutUs::class)->name('aboutUs');
Route::get('/contact-us',ContactUs::class)->name('contactUs');
Route::get('/category/{slug}',CategoryArticles::class)->name('viewCategory');
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
    
    // Route::get('/spatiegenerate',function()
    // {
    //     foreach(Article::get() as $article) {
    //         $article->addMediaFromUrl('https://dummyimage.com/3999x3999/000000/00CED1?text='.$article->slug)
    //                 ->toMediaCollection('cover');
    //     }
    //     dd(Article::find(11)->cover->getUrl('big'));
    // });