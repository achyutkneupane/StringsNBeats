<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use magyarandras\AMPConverter\Converter;
use Spatie\SchemaOrg\Schema;

class AmpController extends Controller
{
    public function render($slug)
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
            $slug = $str;
            return redirect()->route('viewAmpArticle',$slug);
        }
        $keywords = 'StringsNBeats,stringsnbeats.net,strings n beats Nepal,Nepal,Nepali Music,Nepali Artists,Nepali song,';
        $converter = new Converter();
        $converter->loadDefaultConverters();
        $article = Cache::rememberForever('article-'.$slug, function () use ($slug) {
            return Article::with('category','writer','tags','artists','media','comments')->where('slug',$slug)->first();
        });
        $content = $converter->convert($article->content);
        $amp_scripts = $converter->getScripts();
        $coverImage = $article->cover->getUrl();
        if($article) {
            $latests = Cache::rememberForever('latest_five_without_'.$article->id, function () use($article)  {
                return Article::with('media')->orderBy('created_at','DESC')->where('status','active')->where('id','!=',$article->id)->take(5)->get();
            });
            $description = $article->description ? $article->description : Str::limit(strip_tags($article->content),200);
            foreach($article->tags as $tag)
            {
                $keywords = $keywords.$tag->title.',';
            }
            foreach($article->artists as $artist)
            {
                $keywords = $keywords.$artist->name.',';
            }
            $keywords = $keywords.','.$article->title.','.$article->slug.','.$article->category->title.',';
            if(!!!auth()->id()) {
                $article->views++;
                $article->save();
            }
            $schemas = Schema::newsArticle()
                            ->url(route('viewArticle',$article->slug))
                            ->headline($article->title)
                            ->description($description)
                            ->image($article->cover->getUrl())
                            ->datePublished($article->created_at)
                            ->dateModified($article->updated_at)
                            ->commentCount($article->comments->count())
                            ->publisher(Schema::organization()->name('Strings N\' Beats')->email('info@stringsnbeats.net')->logo(Schema::imageObject()->url(asset('statics/logo-small.png'))))
                            ->author($article->writer_flag ? Schema::person()->name($article->writer->name) : Schema::organization()->name('Strings N\' Beats')->email('info@stringsnbeats.net')->logo(Schema::imageObject()->url(asset('statics/logo-small.png'))))
                            ->sameAs(array('https://www.facebook.com/StringsNBeatsNepal/','https://www.instagram.com/stringsnbeats/','https://www.twitter.com/strings_beats'));

            $schemaScripts = $schemas->toScript();
        }
        else {
            return redirect()->route('homepage');
        }
        return view('livewire.pages.article-amp-view', compact(
            'content',
            'article',
            'latests',
            'keywords',
            'description',
            'coverImage',
            'schemaScripts'
        ));
    }
}
