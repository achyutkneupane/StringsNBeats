<?php

namespace App\Http\Livewire\Admin;

use App\Models\Article;
use App\Models\Artist;
use App\Models\Category;
use App\Models\Tag;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class EditArticle extends Component
{
    use WithFileUploads;
    public $articleTitle,$articleCategory,$artists,$featuredImage,$articleContent,$featured,$featuredImageView;
    public $addTagValue,$addArtistValue;
    public $tags,$categories,$artistList;
    public $articleTags,$title,$article;
    public $rules = [
        'articleTitle' => 'required',
        'articleCategory' => 'required',
        'articleTags' => 'required',
        'artists' => 'required',
        'featuredImage' => 'required',
        'articleContent' => 'required',
    ];
    public function mount($articleId)
    {
        $article = Article::with('category','tags','artists')->find($articleId);
        // dd($article);
        $this->articleTitle = $article->title;
        $this->articleContent = $article->content;
        $this->articleCategory = $article->category->id;
        $this->featured = $article->featured;
        $this->articleTags = $article->tags->pluck('id');
        $this->artists = $article->artists->pluck('id');
        $this->featuredImageView = true;
        $this->featuredImage = $article->featured_image;
        $this->title = "Edit Article";
        $this->article = $article;
    }
    public function updated($property)
    {
        if($property = 'featuredImage') {
            $this->featuredImageView = false;
        }
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
    public function editArticle()
    {
        $this->validate();
        $extension = $this->featuredImage->extension();
        $slug = Str::slug($this->articleTitle);
        $path = 'uploads/'.$slug.'-'.now()->timestamp.'.'.$extension;
        $this->featuredImage->storeAs('public',$path);
        $article = $this->article;
        $article->title =  $this->articleTitle;
        $article->content =  $this->articleContent;
        $article->featured =  $this->featured;
        $article->featured_image =  $path;
        $article->status =  'active';
        $article->category_id =  $this->articleCategory;
        $article->writer_id =  auth()->id();
        $article->save();
        $article->tags()->attach($this->articleTags);
        $article->artists()->attach($this->artists);
        redirect()->route('adminEditArticles',$article->id);
    }
    public function render()
    {
        
        $this->tags = Tag::orderBy('title','ASC')->get();
        $this->categories = Category::orderBy('title','ASC')->get();
        $this->artistList = Artist::orderBy('name','ASC')->get();
        return view('livewire.admin.edit-article');
    }
}
