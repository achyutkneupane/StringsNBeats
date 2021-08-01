<?php

namespace App\Http\Livewire\Pages;

use App\Models\Song;
use Carbon\Carbon;
use Livewire\Component;
use Spatie\SchemaOrg\Schema;

class SongView extends Component
{
    public $slug,$song,$duration;
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
            redirect()->route('viewSong',$this->slug);
        }
        $this->slug = $slug;
    }
    public function render()
    {
        $this->song = Song::with('artists','media')->where('slug',$this->slug)->first();
        list($minutes, $seconds) = explode(':', $this->song->duration, 2);
        $this->duration = $seconds+$minutes*60;
        $schemas = Schema::musicRecording()
                         ->byArtist(Schema::musicGroup()
                                          ->legalName($this->song->artists->first()->name))
                         ->duration($this->song->duration)
                         ->thumbnailUrl($this->song->image->getUrl())
                         ->url(route('viewSong',$this->song->slug))
                         ->sameAs(array('https://youtu.be/'.$this->song->youtube,
                                         $this->song->noodle ? 'https://noodlerex.com.np/songs/'.$this->song->noodle : NULL,
                                         $this->song->spotify ? 'https://open.spotify.com/track/'.$this->song->spotify : NULL))
                         ->recordingOf(Schema::musicComposition()
                                            ->name($this->song->title)
                                            ->description($this->song->description)
                                            ->alternateName($this->song->name)
                                            ->composer($this->song->composer)
                                            ->genre($this->song->genre)
                                            ->lyricist(Schema::person()->name($this->song->lyricist))
                                            ->lyrics(Schema::creativeWork()->text(strip_tags($this->song->lyrics_en)))
                                            ->url(route('viewSong',$this->song->slug))
                                            ->recordedAt($this->song->recorded_at)
                                            ->thumbnailUrl($this->song->image->getUrl())
                                            ->sdDatePublished($this->song->published_at)
                                            ->sameAs(array('https://youtu.be/'.$this->song->youtube,
                                                            $this->song->noodle ? 'https://noodlerex.com.np/songs/'.$this->song->noodle : NULL,
                                                            $this->song->spotify ? 'https://open.spotify.com/track/'.$this->song->spotify : NULL)));

        $schemaScripts = $schemas->toScript();
        return view('livewire.pages.song-view',compact('schemaScripts'));
    }
}
