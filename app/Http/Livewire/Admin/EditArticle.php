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
    public $articleTags,$title,$article,$articleContentFinal;
    public $rules = [
        'articleTitle' => 'required',
        'articleCategory' => 'required',
        'articleTags' => 'required',
        'artists' => 'required',
        'featuredImage' => 'required',
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
        $this->featuredImageView = ($article->featured_image !== null);
        $this->featuredImage = $article->featured_image;
        $this->title = "Edit Article";
        $this->article = $article;
        // $this->articleContentFinal = $this->articleContent;
    }
    public function updated($propertyName)
    {
        if($propertyName == 'featuredImage') {
            $this->featuredImageView = false;
        }
        elseif($propertyName == 'articleContent') {
            $this->saveAsDraft();
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
        $article = $this->article;
        if(!$this->featuredImageView) {
            $extension = $this->featuredImage->extension();
            $slug = Str::slug($this->articleTitle);
            $path = 'uploads/'.$slug.'-'.now()->timestamp.'.'.$extension;
            $this->featuredImage->storeAs('public',$path);
            $article->featured_image =  $path;
        }
        $article->title =  $this->articleTitle;
        $article->content =  $this->articleContent;
        $article->featured =  $this->featured;
        if($article->status == 'draft')
        {
            $article->created_at = now();
        }
        $article->status =  'active';
        $article->category_id =  $this->articleCategory;
        $article->save();
        $article->tags()->sync($this->articleTags);
        $article->artists()->sync($this->artists);
        redirect()->route('adminEditArticles',$article->id);
    }
    public function saveAsDraft()
    {
        $this->validate([
            'articleTitle' => 'required',
        ]);
        $article = $this->article;
        if(!$this->featuredImageView && $this->featuredImage) {
            $extension = $this->featuredImage->extension();
            $slug = Str::slug($this->articleTitle);
            $path = 'uploads/'.$slug.'-'.now()->timestamp.'.'.$extension;
            $this->featuredImage->storeAs('public',$path);
            $article->featured_image =  $path;
        }
        $article->title =  $this->articleTitle;
        $article->content =  $this->articleContent;
        $article->featured =  $this->featured;
        $article->status =  'draft';
        $article->category_id =  $this->articleCategory;
        $article->save();
        $article->tags()->sync($this->articleTags);
        $article->artists()->sync($this->artists);
    }
    public function render()
    {
        
        $this->tags = Tag::orderBy('title','ASC')->get();
        $this->categories = Category::orderBy('title','ASC')->get();
        $this->artistList = Artist::orderBy('name','ASC')->get();
        return view('livewire.admin.edit-article');
    }
}
