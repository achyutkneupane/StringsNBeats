<?php

namespace App\Http\Livewire\Admin\Song;

use App\Models\Song;
use Livewire\Component;

class ListSongs extends Component
{
    public $title,$songs;
    public function mount()
    {
        $this->title = "Songs";
    }
    public function deleteSong($songId)
    {
        Song::with('articles','album','artists')->find($songId)->delete();
    }
    public function render()
    {
        $this->songs = Song::with('articles','album','artists')->orderBy('created_at','DESC')->get();
        return view('livewire.admin.song.list-songs');
    }
}
