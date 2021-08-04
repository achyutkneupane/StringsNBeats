<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;

class ListSongs extends Component
{
    public $title,$all;
    public function mount($all = NULL)
    {
        $this->all = $all;
        if($all != NULL && $all != 'all')
        {
            return redirect()->route('listAllSongs','all');
        }
        $this->title = $this->all ? 'All Songs' : 'Songs';
    }
    public function render()
    {
        return view('livewire.pages.list-songs');
    }
}
