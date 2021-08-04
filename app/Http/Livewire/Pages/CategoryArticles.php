<?php

namespace App\Http\Livewire\Pages;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class CategoryArticles extends Component
{
    public $category,$slug,$searchQuery,$title;
    public $listeners = ['updateCategoryQuery'];
    public function updateCategoryQuery($searchQuery)
    {
        $this->searchQuery = $searchQuery;
    }
    public function mount($slug)
    {
        if(strpos($slug,'--')) {
            $str = str_replace('---------------', '-', $slug);
            $str = str_replace('--------------', '-', $slug);
            $str = str_replace('-------------', '-', $slug);
            $str = str_replace('------------', '-', $slug);
            $str = str_replace('-----------', '-', $slug);
            $str = str_replace('----------', '-', $slug);
            $str = str_replace('---------', '-', $slug);
            $str = str_replace('--------', '-', $slug);
            $str = str_replace('-------', '-', $slug);
            $str = str_replace('------', '-', $str);
            $str = str_replace('-----', '-', $str);
            $str = str_replace('----', '-', $str);
            $str = str_replace('---', '-', $str);
            $str = str_replace('--', '-', $str);
            $this->slug = $str;
            redirect()->route('viewCategory',$this->slug);
        }
        $this->searchQuery = '';
        $this->slug = $slug;
    }
    public function render()
    {
        $this->category = Cache::rememberForever('catSlug-'.$this->slug, function () {
            return Category::where('slug',$this->slug)->first();
        });
        if($this->slug == 'all')
        {
            $this->title = 'All Articles';
        }
        else {
            $this->title = $this->category->title;
        }
        return view('livewire.pages.category-articles');
    }
}
