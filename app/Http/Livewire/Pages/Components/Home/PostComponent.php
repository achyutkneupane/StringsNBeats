<?php

namespace App\Http\Livewire\Pages\Components\Home;

use App\Models\Article;
use Livewire\Component;

class PostComponent extends Component
{
    public $article;
    public function mount($article)
    {
        $this->article = $article;
    }
    public function render()
    {
        // $this->article = Article::find($this->articleId);
        return view('livewire.pages.components.home.post-component');
    }
}
