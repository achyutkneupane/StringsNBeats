<?php

namespace App\Http\Livewire\Pages\Components;

use App\Models\Article;
use Livewire\Component;

class HomeBody extends Component
{
    public $newss,$articles,$releases;
    public function render()
    {
        $this->newss = Article::orderBy('created_at','DESC')->where(function($query) {
            $query->where('category_id',1)->where('status','active');
        })->take(4)->get();
        $this->articles = Article::orderBy('created_at','DESC')->where(function($query) {
            $query->where('category_id',3)->where('status','active');
        })->take(4)->get();
        $this->releases = Article::orderBy('created_at','DESC')->where(function($query) {
            $query->where('category_id',2)->where('status','active');
        })->take(4)->get();
        return view('livewire.pages.components.home-body');
    }
}
