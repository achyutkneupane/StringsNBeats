<?php

namespace App\Http\Livewire\Admin\Artist;

use Livewire\Component;

class AddArtist extends Component
{
    public $title = "Add Artist";
    public function render()
    {
        return view('livewire.admin.artist.add-artist');
    }
}
