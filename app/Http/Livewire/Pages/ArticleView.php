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
        $this->keywords = 'StringsNBeats,stringsnbeats.net,strings n beats Nepal,Nepal,Nepali Music,Nepali Artists,Nepali song';
    }
    public function render()
    {
        $this->article = Article::with('category','writer','tags','artists')->where('slug',$this->slug)->first();
        if($this->article) {
            $this->latests = Article::orderBy('created_at','DESC')->where('status','active')->where('id','!=',$this->article->id)->take(6)->get();
            $this->description = $this->article->description ? $this->article->description : Str::limit(strip_tags($this->article->content),200);
            foreach($this->article->tags as $tag)
            {
                $this->keywords = $this->keywords.$tag->title.',';
            }
            foreach($this->article->artists as $artist)
            {
                $this->keywords = $this->keywords.$artist->name.',';
            }
            $this->keywords = $this->keywords.','.$this->article->title.','.$this->article->slug.','.$this->article->category->title.',';
            if(!!!auth()->id()) {
                $this->article->views++;
                $this->article->save();
            }
        }
        else
        redirect()->route('homepage');
        return view('livewire.pages.article-view');
    }
}
