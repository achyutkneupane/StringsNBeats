<?php

namespace App\Http\Livewire\Pages\Components;

use App\Models\Article;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class HomeBody extends Component
{
    public $newss,$articles,$releases;
    public function render()
    {
        $this->newss = Cache::rememberForever('latest_four_news', function () {
            return Article::with('media')->orderBy('created_at','DESC')->where(function($query) {
                $query->where('category_id',1)->where('status','active');
            })->take(4)->get();
        });
        $this->articles = Cache::rememberForever('latest_four_articles', function () {
            return Article::with('media')->orderBy('created_at','DESC')->where(function($query) {
                $query->where('category_id',3)->where('status','active');
            })->take(4)->get();
        });
        $this->releases = Cache::rememberForever('latest_four_releases', function () {
            return Article::with('media')->orderBy('created_at','DESC')->where(function($query) {
                $query->where('category_id',2)->where('status','active');
            })->take(4)->get();
        });
        return view('livewire.pages.components.home-body');
    }
}
