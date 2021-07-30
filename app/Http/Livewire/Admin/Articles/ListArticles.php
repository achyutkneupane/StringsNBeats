<?php

namespace App\Http\Livewire\Admin\Articles;

use App\Models\Article;
use Livewire\Component;

class ListArticles extends Component
{
    public $title,$articles;
    public function mount()
    {
        $this->title = "Articles";
    }
    public function render()
    {
        $this->articles = Article::orderBy('created_at','DESC')->with('category','writer')->get();
        return view('livewire.admin.articles.list-articles');
    }
}
