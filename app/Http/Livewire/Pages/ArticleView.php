<?php

namespace App\Http\Livewire\Pages;

use App\Models\Article;
use Livewire\Component;
use Illuminate\Support\Str;

class ArticleView extends Component
{
    public $slug,$article,$latests,$description,$keywords;
    public function mount($slug)
    {
        $this->slug = $slug;
        $this->keywords = '';
    }
    public function render()
    {
        $this->article = Article::with('category','writer','tags','artists')->where('slug',$this->slug)->first();
        $this->latests = Article::orderBy('created_at','DESC')->where('status','active')->take(5)->get();
        $this->description = Str::limit(strip_tags($this->article->content),200);
        $this->keywords = $this->article->title.','.$this->article->category->title.',';
        foreach($this->article->tags as $tag)
        {
            $this->keywords = $this->keywords.$tag->title.',';
        }
        foreach($this->article->artists as $artist)
        {
            $this->keywords = $this->keywords.$artist->name.',';
        }
        $this->article->views++;
        $this->article->save();
        return view('livewire.pages.article-view');
    }
}
