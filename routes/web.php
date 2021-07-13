<?php

use App\Http\Livewire\Admin\AddArticle;
use App\Http\Livewire\Admin\AddYoutube;
use App\Http\Livewire\Admin\Articles;
use App\Http\Livewire\Admin\EditArticle;
use App\Http\Livewire\Admin\Dashboard;
use App\Http\Livewire\Pages\AboutUs;
use App\Http\Livewire\Pages\ArticleView;
use App\Http\Livewire\Pages\ContactUs;
use App\Http\Livewire\Pages\LandingPage;
use App\Http\Livewire\Pages\Login;
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

Route::get('/',LandingPage::class)->name('homepage');

Route::get('robots.txt', function(Robots $robots) {
    $robots->addUserAgent('*');
    if ($robots->shouldIndex()) {
        $robots->addDisallow('/panel');
        $robots->addSitemap('sitemap.xml');
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
Route::get('/{slug}',ArticleView::class)->name('viewArticle');

// Auth::routes();