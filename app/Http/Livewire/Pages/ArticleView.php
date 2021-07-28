<?php

namespace App\Http\Livewire\Pages;

use App\Models\Article;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Illuminate\Support\Str;
use Spatie\SchemaOrg\Schema;

class ArticleView extends Component
{
    public $slug,$article,$latests,$description,$keywords,$populars,$artistArticles;
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
            redirect()->route('viewArticle',$this->slug);
        }
        $this->keywords = 'StringsNBeats,stringsnbeats.net,strings n beats Nepal,Nepal,Nepali Music,Nepali Artists,Nepali song';
    }
    public function render()
    {
        $this->article = Cache::rememberForever('article-'.$this->slug, function () {
            return Article::with('category','writer','tags','artists.articles.media','media','comments')->where('slug',$this->slug)->first();
        });
        if($this->article) {
            $this->latests = Cache::rememberForever('latest_five_without_'.$this->article->id, function () {
                return Article::with('media')->orderBy('created_at','DESC')->where('status','active')->where('id','!=',$this->article->id)->take(5)->get();
            });
            $this->populars = Cache::rememberForever('popular_five_without_'.$this->article->id, function () {
                return Article::with('media')->orderBy('views','DESC')->where('status','active')->where('id','!=',$this->article->id)->take(5)->get();
            });
            $this->artistArticles = Cache::rememberForever('artist_articles_without_'.$this->article->id, function () {
                $articless = collect();
                foreach($this->article->artists as $artist)
                {
                    foreach($artist->articles as $articlee) {
                        if($articlee->status == 'active' && $articlee->id != $this->article->id) {
                            if(!$articless->contains('id',$articlee->id)) {
                                $articless->push($articlee);
                            }
                        }
                    }
                }
                return $articless->sortByDesc('views');
            });
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
            $schemas = Schema::article()
                            ->mainEntityOfPage(Schema::webSite()->url(route('homepage')))
                            ->url(route('viewArticle',$this->article->slug))
                            ->headline($this->article->title)
                            ->description($this->description)
                            ->image($this->article->cover->getUrl())
                            ->datePublished($this->article->created_at)
                            ->dateModified($this->article->updated_at)
                            ->commentCount($this->article->comments->count())
                            ->publisher(Schema::organization()->name('Strings N\' Beats')->email('info@stringsnbeats.net')->logo(Schema::imageObject()->url(asset('statics/logo-small.png'))))
                            ->author($this->article->writer_flag ? Schema::person()->name($this->article->writer->name) : Schema::organization()->name('Strings N\' Beats')->email('info@stringsnbeats.net')->logo(Schema::imageObject()->url(asset('statics/logo-small.png'))))
                            ->sameAs(array('https://www.facebook.com/StringsNBeatsNepal/','https://www.instagram.com/stringsnbeats/','https://www.twitter.com/strings_beats'));

            $schemaScripts = $schemas->toScript();
        }
        else
        redirect()->route('homepage');
        return view('livewire.pages.article-view',compact('schemaScripts'));
    }
}
