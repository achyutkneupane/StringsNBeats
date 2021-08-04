<?php

namespace App\Http\Livewire\Pages\Components\Song;

use App\Models\Song;
use Livewire\Component;

class SongComponent extends Component
{
    public $song;
    public function mount(Song $song)
    {
        $this->song = $song;
    }
    public function render()
    {
        return view('livewire.pages.components.song.song-component');
    }
}
