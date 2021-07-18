<?php

namespace App\Http\Livewire\Admin;

use App\Models\Article;
use App\Models\Artist;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class EditArticle extends Component
{
    use WithFileUploads;
    public $articleTitle,$articleCategory,$artists,$featuredImage,$articleContent,$featured,$featuredImageView,$articleDescription,$articleSlug;
    public $addTagValue,$addArtistValue;
    public $tags,$categories,$artistList;
    public $articleTags,$title,$article,$articleContentFinal;
    public $rules = [
        'articleTitle' => 'required|min:35|max:65',
        'articleCategory' => 'required',
        'articleTags' => 'required',
        'artists' => 'required',
        'featuredImage' => 'required',
        'articleDescription' => 'required|min:70|max:320',
        'articleSlug' => 'required',
    ];
    public function mount($articleId)
    {
        $article = Article::with('category','tags','artists','writer')->find($articleId);
        // dd($article);
        $this->articleTitle = $article->title;
        $this->articleContent = $article->content;
        $this->articleCategory = $article->category->id;
        $this->featured = $article->featured;
        $this->articleTags = $article->tags->pluck('id');
        $this->artists = $article->artists->pluck('id');
        $this->articleDescription = $article->description;
        $this->articleSlug = $article->slug;
        $this->featuredImageView = ($article->cover !== null);
        $this->featuredImage = $article->cover ? $article->cover->getUrl() : NULL;
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
            if($this->article->writer->id == auth()->id())
                $this->saveAsDraft();
        }
    }
    public function editArticle()
    {
        $articleTags = array();
        $artists = array();
        $this->validate();
        $article = $this->article;
        $article->title =  $this->articleTitle;
        $article->content =  $this->articleContent;
        $article->featured =  $this->featured;
        if($article->status == 'draft')
        {
            $article->created_at = now();
        }
        $article->status =  'active';
        $article->category_id =  $this->articleCategory;
        $article->description = $this->articleDescription;
        $article->slug = $this->articleSlug;
        $article->save();
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
            'articleSlug' => 'required'
        ]);
        $article = $this->article;
        if(!$this->featuredImageView && $this->featuredImage) {
            $extension = $this->featuredImage->extension();
            $slug = Str::slug($this->articleTitle);
            $path = $slug.'-'.now()->timestamp.'.'.$extension;
            $article->addMedia($this->featuredImage->getRealPath())
                    ->usingFileName($path)
                    ->usingName($path)
                    ->toMediaCollection('cover');
        }
        $article->title =  $this->articleTitle;
        $article->content =  $this->articleContent;
        $article->featured =  $this->featured;
        $article->status =  'draft';
        $article->category_id =  $this->articleCategory;
        $article->description = $this->articleDescription;
        $article->slug = $this->articleSlug;
        $article->save();
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
    }
    public function render()
    {
        
        $this->tags = Tag::orderBy('title','ASC')->get();
        $this->categories = Category::orderBy('title','ASC')->get();
        $this->artistList = Artist::orderBy('name','ASC')->get();
        return view('livewire.admin.edit-article');
    }
}
