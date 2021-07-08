<?php

use App\Http\Livewire\Admin\AddArticle;
use App\Http\Livewire\Admin\Articles;
use App\Http\Livewire\Admin\EditArticle;
use App\Http\Livewire\Admin\Dashboard;
use App\Http\Livewire\Pages\AboutUs;
use App\Http\Livewire\Pages\ArticleView;
use App\Http\Livewire\Pages\ContactUs;
use App\Http\Livewire\Pages\LandingPage;
use App\Http\Livewire\Pages\Login;
use App\Mail\YoutubeDateErrorMail;
use App\Mail\YoutubeErrorMail;
use App\Models\YoutubeLink;
use App\Notifications\YoutubeNotification;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Route;

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


Route::prefix('/panel')->middleware('auth')->group(function() {
    Route::get('/',Dashboard::class)->name('adminDashboard');
    Route::get('/articles',Articles::class)->name('adminArticles');
    Route::get('/articles/add',AddArticle::class)->name('adminAddArticles');
    Route::get('/articles/edit/{articleId}',EditArticle::class)->name('adminEditArticles');
});

Route::get('/login',Login::class)->name('login');
Route::get('/about-us',AboutUs::class)->name('aboutUs');
Route::get('/contact-us',ContactUs::class)->name('contactUs');
Route::get('/{slug}',ArticleView::class)->name('viewArticle');

// Auth::routes();