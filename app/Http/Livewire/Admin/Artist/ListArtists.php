<?php

namespace App\Http\Livewire\Admin\Artist;

use App\Models\Artist;
use Livewire\Component;

class ListArtists extends Component
{
    public $title,$artists;
    public function mount()
    {
        $this->title = "Artists";
    }
    public function deleteArtist($artistId)
    {
        Artist::with('articles','albums','songs')->find($artistId)->delete();
    }
    public function render()
    {
        $this->artists = Artist::with('articles','albums','songs')->orderBy('created_at','DESC')->get();
        return view('livewire.admin.artist.list-artists');
    }
}
