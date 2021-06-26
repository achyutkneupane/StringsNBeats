<?php

namespace App\Http\Livewire\Admin;

use App\Models\Article;
use Livewire\Component;

class Articles extends Component
{
    public $title;
    public function mount()
    {
        $this->title = "Articles";
    }
    public function render()
    {
        $articles = Article::orderBy('created_at','DESC')->with('category','writer')->get();
        return view('livewire.admin.articles',compact('articles'));
    }
}
