<?php

namespace App\Http\Livewire\Pages;

use App\Http\Livewire\Pages\Components\Navbar;
use App\Models\Article;
use Livewire\Component;

class LandingPage extends Component
{
    public $q,$perPage,$activePerPage,$page,$allArticles;
    public $listeners = [
        'updateHomeSearch'
    ];
    public $queryString = [
        'q' => ['except' => ''],
    ];
    public function mount()
    {
        $this->perPage = 10;
        $this->activePerPage = $this->perPage;
    }
    public function loadMore()
    {
        $this->activePerPage += $this->perPage;
    }
    public function updateHomeSearch($queryTerm)
    {
        $this->q = $queryTerm;
    }
    public function render()
    {
        $articleSearchTerm = '%'.$this->q.'%';
        $articles = NULL;
        if($this->q) {
            $articles = Article::with('media','category','writer')
                            ->orderBy('created_at','DESC')
                            ->where('status','active')
                            ->where(function($query) use($articleSearchTerm) {
                                $query->where('title','like',$articleSearchTerm)
                                    ->orWhere('description','like',$articleSearchTerm)
                                    ->orWhereHas('tags', function($tag) use($articleSearchTerm) {
                                        $tag->where('title','like',$articleSearchTerm);
                                    })
                                    ->orWhereHas('artists', function($artist) use($articleSearchTerm) {
                                        $artist->where('name','like',$articleSearchTerm);
                                });
                            })->take($this->activePerPage)->get();
                        }
        return view('livewire.pages.landing-page',compact('articles'));
    }
}
