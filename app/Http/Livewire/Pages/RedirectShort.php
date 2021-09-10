<?php

namespace App\Http\Livewire\Pages;

use App\Models\ShortLink;
use Livewire\Component;

class RedirectShort extends Component
{
    public $long;
    public function mount($tag = NULL)
    {
        if($tag == NULL)
        {
            return redirect()->route('homepage');
        }
        else
        {
            $shortCheck = ShortLink::where('tag',$tag);
            if($shortCheck->count() == 0)
            {
                return redirect()->route('homepage');
            }
            else {
                $this->long = $shortCheck->first();
                $this->long->count+=1;
                $this->long->save();
            }
        }
    }
    public function render()
    {
        return view('livewire.pages.redirect-short');
    }
}
