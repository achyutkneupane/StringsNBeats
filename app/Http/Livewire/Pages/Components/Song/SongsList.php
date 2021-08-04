<?php

namespace App\Http\Livewire\Pages\Components\Song;

use App\Models\Song;
use Livewire\Component;

class SongsList extends Component
{
    public $perPage,$activePerPage,$songs,$q,$all,$title;
    protected $queryString = [
        'q' => ['except' => ''],
    ];
    public function mount($all = NULL)
    {
        $this->all = $all;
        $this->perPage = 9;
        $this->activePerPage = $this->perPage;
        $this->title = $this->all ? 'All Songs' : 'Songs';
    }
    public function loadMore()
    {
        $this->activePerPage += $this->perPage;
    }
    public function render()
    {
        $songSearchTerm = '%'.$this->q.'%';
        if($this->all == 'all')
        {
            $this->songs = Song::with('artists','media')->orderBy('created_at','DESC')->where(function($query) {
                    $query->where('published_at','!=',NULL);
                })->where(function($query) use($songSearchTerm) {
                    $query->where('title','like',$songSearchTerm)
                        ->orWhere('name','like',$songSearchTerm)
                        ->orWhere('composer','like',$songSearchTerm)
                        ->orWhere('arranger','like',$songSearchTerm)
                        ->orWhere('lyricist','like',$songSearchTerm)
                        ->orWhereHas('artists', function($artist) use($songSearchTerm) {
                                $artist->where('name','like',$songSearchTerm);
                        });
                })
                ->get();
        }
        else
        {
            $this->songs = Song::with('artists')->orderBy('created_at','DESC')->where(function($query) {
                    $query->where('published_at','!=',NULL);
                })->where(function($query) use($songSearchTerm) {
                    $query->where('title','like',$songSearchTerm)
                        ->orWhere('name','like',$songSearchTerm)
                        ->orWhere('composer','like',$songSearchTerm)
                        ->orWhere('arranger','like',$songSearchTerm)
                        ->orWhere('lyricist','like',$songSearchTerm)
                        ->orWhereHas('artists', function($artist) use($songSearchTerm) {
                                $artist->where('name','like',$songSearchTerm);
                        });
                })
                ->take($this->activePerPage)->get();
        }
        return view('livewire.pages.components.song.songs-list');
    }
}
