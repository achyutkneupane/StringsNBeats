<?php

namespace App\Http\Livewire\Admin\Song;

use App\Models\Artist;
use App\Models\Song;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditSong extends Component
{
    use WithFileUploads;
    public $title,$song,$artistList,$featuredImageView;
    public $songTitle,
           $songName,
           $songSlug,
           $songComposer,
           $songLyricist,
           $songArranger,
           $songGenre,
           $songDuration,
           $songISRCCode,
           $songYoutube,
           $songNoodle,
           $songSpotify,
           $songDescription,
           $songSummary,
           $songRecordedAt,
           $songReleasedAt,
           $songLyricsNp,
           $songLyricsEn,
           $artists,
           $featuredImage;
    public function mount($songId)
    {
        $this->song = Song::with('artists')->find($songId);
        $this->title = "Edit ".ucwords($this->song->title);
        $this->songTitle = ucwords($this->song->title);
        $this->songName = ucwords($this->song->name);
        $this->songSlug = $this->song->slug;
        $this->songComposer = $this->song->composer;
        $this->songLyricist = $this->song->lyricist;
        $this->songArranger = $this->song->arranger;
        $this->songGenre = $this->song->genre;
        $this->songDuration = $this->song->duration;
        $this->songISRCCode = $this->song->isrcCode;
        $this->songYoutube = $this->song->youtube;
        $this->songNoodle = $this->song->noodle;
        $this->songSpotify = $this->song->spotify;
        $this->songDescription = $this->song->description;
        $this->songSummary = $this->song->summary;
        $this->songRecordedAt = $this->song->recorded_at;
        $this->songReleasedAt = $this->song->released_at;
        $this->songLyricsNp = $this->song->lyrics_np;
        $this->songLyricsEn = $this->song->lyrics_en;
        $this->artists = $this->song->artists->pluck('id');
        $this->featuredImageView = ($this->song->image !== null);
        $this->featuredImage = $this->featuredImageView ? $this->song->image->getUrl() : NULL;
    }
    public function updated($propertyName)
    {
        if($propertyName == 'featuredImage') {
            $this->featuredImageView = false;
        }
    }
    public function editSong()
    {
        $artists = array();
        $song = $this->song;
        $song->title = $this->songTitle;
        $song->name = $this->songName;
        $song->slug = $this->songSlug;
        $song->composer = $this->songComposer;
        $song->lyricist = $this->songLyricist;
        $song->arranger = $this->songArranger;
        $song->genre = $this->songGenre;
        $song->duration = $this->songDuration;
        $song->isrcCode = $this->songISRCCode;
        $song->youtube = $this->songYoutube;
        $song->noodle = $this->songNoodle;
        $song->spotify = $this->songSpotify;
        $song->description = $this->songDescription;
        $song->summary = $this->songSummary;
        $song->recorded_at = $this->songRecordedAt;
        $song->released_at = $this->songReleasedAt;
        $song->lyrics_np = $this->songLyricsNp;
        $song->lyrics_en = $this->songLyricsEn;
        $song->published_at = now();
        $song->save();
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
        $song->artists()->sync($artists);
        if(!$this->featuredImageView) {
            $extension = $this->featuredImage->extension();
            $slug = $this->songSlug;
            $path = $slug.'-'.now()->timestamp.'.'.$extension;
            $song->addMedia($this->featuredImage->getRealPath())
                    ->usingFileName($path)
                    ->usingName($path)
                    ->toMediaCollection('image');
        }
        $this->featuredImageView = true;
        $this->featuredImage = Song::with('media')->find($song->id)->image->getUrl('big');
    }
    public function render()
    {
        $this->artistList = Artist::orderBy('name','ASC')->get();
        return view('livewire.admin.song.edit-song');
    }
}
