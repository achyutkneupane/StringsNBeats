<?php

namespace App\Http\Livewire\Admin;

use App\Models\Article;
use App\Models\Artist;
use App\Models\Category;
use App\Models\Tag;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class AddArticle extends Component
{
    use WithFileUploads;
    public $articleTitle,$articleCategory,$artists,$featuredImage,$articleContent,$featured;
    public $addTagValue,$addArtistValue;
    public $tags,$categories,$artistList;
    public $articleTags,$title;
    public $rules = [
        'articleTitle' => 'required',
        'articleCategory' => 'required',
        'articleTags' => 'required',
        'artists' => 'required',
        'featuredImage' => 'required',
        'articleContent' => 'required',
    ];
    public function mount()
    {
        $this->articleCategory = "";
        $this->articleTags = [];
        $this->artists = [];
        $this->title = "Add Article";
    }
    public function addArtist()
    {
        $this->validate([
            'addArtistValue' => 'required'
        ]);
        Artist::create([
            'name' => $this->addArtistValue
        ]);
        $this->reset('addArtistValue');
    }
    public function addTag()
    {
        $this->validate([
            'addTagValue' => 'required'
        ]);
        Tag::create([
            'title' => $this->addTagValue
        ]);
        $this->reset('addTagValue');
    }
    public function storeArticle()
    {
        $this->validate();
        $extension = $this->featuredImage->extension();
        $slug = Str::slug($this->articleTitle);
        $path = 'uploads/'.$slug.'-'.now()->timestamp.'.'.$extension;
        $this->featuredImage->storeAs('public',$path);
        $article = Article::create([
            'title' => $this->articleTitle,
            'content' => $this->articleContent,
            'featured' => $this->featured,
            'featured_image' => $path,
            'status' => 'active',
            'category_id' => $this->articleCategory,
            'writer_id' => auth()->id()
        ]);
        $article->tags()->attach($this->articleTags);
        $article->artists()->attach($this->artists);
        redirect()->route('adminEditArticles',$article->id);
    }
    public function render()
    {
        $this->tags = Tag::orderBy('title','ASC')->get();
        $this->categories = Category::orderBy('title','ASC')->get();
        $this->artistList = Artist::orderBy('name','ASC')->get();
        return view('livewire.admin.add-article');
    }
}
