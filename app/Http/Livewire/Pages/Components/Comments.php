<?php

namespace App\Http\Livewire\Pages\Components;

use App\Models\Article;
use App\Models\Comment;
use Livewire\Component;

class Comments extends Component
{
    public $articleId,$comments;
    public $email,$fullName,$comment;
    public $rules = [
        'email' => '',
        'fullName' => '',
        'comment' => 'required|min:20'
    ];
    public function mount($articleId)
    {
        $this->articleId = $articleId;
    }
    public function comment()
    {
        $this->validate();
        Article::find($this->articleId)->comments()->create([
            'email' => $this->email,
            'name' => $this->fullName,
            'content' => $this->comment
        ]);
        $this->reset(['email','fullName','comment']);
    }
    public function render()
    {
        $this->comments = Comment::orderBy('created_at','DESC')->where('article_id',$this->articleId)->get();
        return view('livewire.pages.components.comments');
    }
}
