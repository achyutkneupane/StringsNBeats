<?php

namespace App\Http\Livewire\Pages;

use App\Models\Article;
use App\Models\Artist;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Illuminate\Support\Str;
use Spatie\SchemaOrg\Schema;
use magyarandras\AMPConverter\Converter;

class ArticleAmpView extends Component
{public $slug,$article,$latests,$description,$keywords,$populars,$artistArticles,$coverImage,$content,$amp_scripts;
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
        $this->keywords = 'StringsNBeats,stringsnbeats.net,strings n beats Nepal,Nepal,Nepali Music,Nepali Artists,Nepali song,';
    }
    public function render()
    {
        $converter = new Converter();
        $converter->loadDefaultConverters();
        $this->article = Cache::rememberForever('article-'.$this->slug, function () {
            return Article::with('category','writer','tags','artists','media','comments')->where('slug',$this->slug)->first();
        });
        $this->content = $converter->convert($this->article->content);
        $this->amp_scripts = $converter->getScripts();
        $this->coverImage = $this->article->cover->getUrl();
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
                    foreach(Artist::with('articles.media')->find($artist->id)->articles as $articlee) {
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
        return view('livewire.pages.article-amp-view', compact('schemaScripts'));
    }
}
