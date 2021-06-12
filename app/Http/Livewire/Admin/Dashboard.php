<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class Dashboard extends Component
{
    public $title;
    public function mount()
    {
        $this->title = "Dashboard";
    }
    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
