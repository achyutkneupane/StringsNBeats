<?php

namespace App\Http\Livewire\Pages\Components;

use App\Models\Article;
use Livewire\Component;

class HomeTop extends Component
{
    public $latests,$featured;
    public function render()
    {
        $this->latests = Article::orderBy('created_at','DESC')->where('status','active')->take(4)->get();
        $this->featured = Article::orderBy('created_at','DESC')->where('status','active')->where('featured',true)->take(3)->get();
        return view('livewire.pages.components.home-top');
    }
}
