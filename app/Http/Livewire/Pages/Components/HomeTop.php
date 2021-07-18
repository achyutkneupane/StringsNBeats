<?php

namespace App\Http\Livewire\Pages\Components;

use App\Models\Article;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class HomeTop extends Component
{
    public $latests,$featured;
    public function render()
    {
        $this->latests = Cache::rememberForever('latest_four', function () {
            return Article::with('media')->orderBy('created_at','DESC')->where('status','active')->take(4)->get();
        });
        $this->featured = Cache::rememberForever('latest_featured', function () {
            return Article::with('media')->orderBy('created_at','DESC')->where('status','active')->where('featured',true)->take(3)->get();
        });
        return view('livewire.pages.components.home-top');
    }
}
