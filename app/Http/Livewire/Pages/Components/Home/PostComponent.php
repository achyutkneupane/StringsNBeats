<?php

namespace App\Http\Livewire\Pages\Components\Home;

use App\Models\Article;
use Livewire\Component;

class PostComponent extends Component
{
    public $articleId,$article;
    public function mount($articleId)
    {
        $this->articleId = $articleId;
    }
    public function render()
    {
        $this->article = Article::find($this->articleId);
        return view('livewire.pages.components.home.post-component');
    }
}
