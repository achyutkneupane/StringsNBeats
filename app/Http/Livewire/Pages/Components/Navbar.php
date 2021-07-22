<?php

namespace App\Http\Livewire\Pages\Components;

use Livewire\Component;

class Navbar extends Component
{
    public $queryTerm;
    public function mount($q = '')
    {
        $this->queryTerm = $q;
        $this->emit('updateHomeSearch',$this->queryTerm);
    }
    public function render()
    {
        $this->emit('updateHomeSearch',$this->queryTerm);
        return view('livewire.pages.components.navbar');
    }
}
