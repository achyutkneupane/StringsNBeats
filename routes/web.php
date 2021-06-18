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
use App\Models\YoutubeChannel;
use App\Models\YoutubeLink;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/generateYoutubeLinks',function() {
//     $api = 'AIzaSyD8VE4bbtAlAy2yZ-cfpblnP_Y327Kvdpc';
//     $pageToken = "";
//     foreach(YoutubeChannel::where('fetched',false)->get() as $channel) {
//         do
//         {
//             $videoClient = new Client();
//             $requestVideo = $videoClient->get('https://www.googleapis.com/youtube/v3/search?key='.$api.'&channelId='.$channel->link.'&part=id,snippet&maxResults=50&pageToken='.$pageToken);
//             $resultVideo = json_decode($requestVideo->getBody());
//             foreach($resultVideo->items as $video)
//             {
//                 if(isset($video->id->videoId))
//                 {
//                     try {
//                     YoutubeLink::create([
//                         'link'=>$video->id->videoId,
//                     ]);
//                     }
//                     catch(Exception $e) {
//                     }
//                 }
//             }
//             if(isset($resultVideo->nextPageToken)) {
//                 $pageToken = $resultVideo->nextPageToken;
//             }
//             else {
//                 $channel->fetched = true;
//                 $channel->save();
//             }
//         } while(isset($resultVideo->nextPageToken));
//         }
//     }
// );

Route::get('/',LandingPage::class)->name('homepage');


Route::prefix('/panel')->group(function() {
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