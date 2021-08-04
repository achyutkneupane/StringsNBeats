<?php

namespace App\Http\Livewire\Pages\Components\Category;

use App\Models\Article;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class ArticleList extends Component
{
    public $categoryId,$perPage,$activePerPage,$category,$q,$p,$title;
    protected $queryString = [
        'q' => ['except' => ''],
    ];
    public function mount($category)
    {
        $this->category = $category;
        if($this->category == null)
        {
            $this->title = 'All Articles';
        }
        else
        {
            $this->title = $this->category->title;
            $this->categoryId = $category->id;
        }
        $this->perPage = 10;
        $this->activePerPage = $this->perPage;
    }
    public function loadMore()
    {
        $this->activePerPage += $this->perPage;
    }
    public function render()
    {
        $articleSearchTerm = '%'.$this->q.'%';
        if($this->category == null)
        {
            $articles = Article::with('media','writer')->orderBy('created_at','DESC')->where(function($query) {
                    $query->where('status','active');
                })->where(function($query) use($articleSearchTerm) {
                    $query->where('title','like',$articleSearchTerm)
                          ->orWhere('description','like',$articleSearchTerm)
                          ->orWhereHas('tags', function($tag) use($articleSearchTerm) {
                              $tag->where('title','like',$articleSearchTerm);
                          })
                          ->orWhereHas('artists', function($artist) use($articleSearchTerm) {
                                $artist->where('name','like',$articleSearchTerm);
                          });
                })
                ->get();
        }
        else
        {
            $articles = Article::with('media','writer')->orderBy('created_at','DESC')->where(function($query) {
                    $query->where('category_id',$this->categoryId)->where('status','active');
                })->where(function($query) use($articleSearchTerm) {
                    $query->where('title','like',$articleSearchTerm)
                          ->orWhere('description','like',$articleSearchTerm)
                          ->orWhereHas('tags', function($tag) use($articleSearchTerm) {
                              $tag->where('title','like',$articleSearchTerm);
                          })
                          ->orWhereHas('artists', function($artist) use($articleSearchTerm) {
                                $artist->where('name','like',$articleSearchTerm);
                          });
                })
                ->take($this->activePerPage)->get();
        }
        return view('livewire.pages.components.category.article-list', compact('articles'));
    }
}
