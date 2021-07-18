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
    public $articleTitle,$articleCategory,$artists,$featuredImage,$articleContent,$featured,$articleDescription;
    public $addTagValue,$addArtistValue;
    public $tags,$categories,$artistList;
    public $articleTags,$title;
    public $rules = [
        'articleTitle' => 'required|min:20|max:45',
        'articleCategory' => 'required',
        'articleTags' => 'required',
        'artists' => 'required',
        'featuredImage' => 'required',
        'articleContent' => 'required',
        'articleDescription' => 'required|min:70|max:320',
    ];
    public function mount()
    {
        $this->articleTags = [];
        $this->artists = [];
        $this->title = "Add Article";
        $this->articleCategory = 1;
    }
    public function storeArticle()
    {
        $articleTags = array();
        $artists = array();
        $this->validate();
        $extension = $this->featuredImage->extension();
        $slug = Str::slug($this->articleTitle);
        $path = 'uploads/'.$slug.'-'.now()->timestamp.'.'.$extension;
        $this->featuredImage->storeAs('public',$path);
        $article = Article::create([
            'title' => $this->articleTitle,
            'content' => $this->articleContent,
            'featured' => $this->featured,
            'status' => 'active',
            'description' => $this->articleDescription,
            'category_id' => $this->articleCategory,
            'writer_id' => auth()->id()
        ]);
        $path = null;
        if($this->featuredImage) {
            $extension = $this->featuredImage->extension();
            $slug = Str::slug($this->articleTitle);
            $path = $slug.'-'.now()->timestamp.'.'.$extension;
            $article->addMedia($this->featuredImage->getRealPath())
                    ->usingFileName($path)
                    ->usingName($path)
                    ->toMediaCollection('cover');
        }
        foreach($this->articleTags as $tag)
        {
            if(!Tag::where('id',$tag)->count())
            {
                $t = Tag::create([
                    'title' => $tag
                ]);
                array_push($articleTags,$t->id);
            }
            else
            {
                array_push($articleTags,$tag);
            }
        }
        foreach($this->artists as $artist)
        {
            if(!Artist::where('id',$artist)->count())
            {
                $a = Artist::create([
                    'name' => $artist
                ]);
                array_push($artists,$a->id);
            }
            else
            {
                array_push($artists,$artist);
            }
        }
        $article->tags()->sync($articleTags);
        $article->artists()->sync($artists);
        redirect()->route('adminEditArticles',$article->id);
    }
    public function saveAsDraft()
    {
        $articleTags = array();
        $artists = array();
        $this->validate([
            'articleTitle' => 'required|min:35|max:65',
        ]);
        $article = Article::create([
            'title' => $this->articleTitle,
            'content' => $this->articleContent,
            'status' => 'draft',
            'description' => $this->articleDescription,
            'category_id' => $this->articleCategory,
            'writer_id' => auth()->id()
        ]);
        $path = null;
        if($this->featuredImage) {
            $extension = $this->featuredImage->extension();
            $slug = Str::slug($this->articleTitle);
            $path = $slug.'-'.now()->timestamp.'.'.$extension;
            $article->addMedia($this->featuredImage->getRealPath())
                    ->usingFileName($path)
                    ->usingName($path)
                    ->toMediaCollection('cover');
        }
        foreach($this->articleTags as $tag)
        {
            if(!Tag::where('id',$tag)->count())
            {
                $t = Tag::create([
                    'title' => $tag
                ]);
                array_push($articleTags,$t->id);
            }
            else
            {
                array_push($articleTags,$tag);
            }
        }
        foreach($this->artists as $artist)
        {
            if(!Artist::where('id',$artist)->count())
            {
                $a = Artist::create([
                    'name' => $artist
                ]);
                array_push($artists,$a->id);
            }
            else
            {
                array_push($artists,$artist);
            }
        }
        $article->tags()->sync($articleTags);
        $article->artists()->sync($artists);
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
