<?php

namespace App\Http\Livewire\Admin;

use App\Models\ShortLink;
use Livewire\Component;
use Livewire\WithPagination;

class ShortUrl extends Component
{
    public $short,$long,$description;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $searchTerm;
    public function shorten()
    {
        $this->validate([
            'short' => 'required',
            'long' => 'required',
            'description' => ''
        ]);
        $longCheck = ShortLink::where('long',$this->long);
        $shortCheck = ShortLink::where('tag',$this->short);
        if($shortCheck->count() > 0)
        {
            $this->addError('short','This tag is already used for '.$shortCheck->first()->long);
        }
        elseif($longCheck->count() > 0)
        {
            $this->addError('long','This Url is already under tag '.$longCheck->first()->tag);
        }
        else {
            ShortLink::create([
                'long' => $this->long,
                'tag' => strtolower($this->short),
                'description' => $this->description,
            ]);
            $this->reset('short','long','description');
        }
    }
    public function render()
    {
        $search_term = '%'.$this->searchTerm.'%';
        $links = ShortLink::where('long','like',$search_term)->orWhere('tag','like',$search_term)->orWhere('description','like',$search_term)->paginate(10);
        return view('livewire.admin.short-url',compact('links'));
    }
}
