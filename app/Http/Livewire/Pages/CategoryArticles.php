<?php

namespace App\Http\Livewire\Pages;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class CategoryArticles extends Component
{
    public $category,$slug,$searchQuery;
    public $listeners = ['updateCategoryQuery'];
    public function updateCategoryQuery($searchQuery)
    {
        $this->searchQuery = $searchQuery;
    }
    public function mount($slug)
    {
        $this->searchQuery = '';
        $this->slug = $slug;
    }
    public function render()
    {
        $this->category = Cache::rememberForever('catSlug-'.$this->slug, function () {
            return Category::where('slug',$this->slug)->first();
        });
        return view('livewire.pages.category-articles');
    }
}
