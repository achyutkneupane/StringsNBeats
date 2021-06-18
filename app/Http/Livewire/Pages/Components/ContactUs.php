<?php

namespace App\Http\Livewire\Pages\Components;

use App\Mail\ContactUsForUser;
use App\Mail\ContactUsMail;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ContactUs extends Component
{
    public $email,$name,$message,$formSubmitted;
    public $rules = [
        'email' => 'required|email',
        'name' => 'required',
        'message' => 'required|min:20'
    ];
    public function sendContact()
    {
        $this->validate();
        $info = collect();
        $info->put('email',$this->email);
        $info->put('name',$this->name);
        $info->put('message',$this->message);
        Mail::to('info@stringsnbeats.net')
            ->send(new ContactUsMail($info));
        Mail::to($this->email)
            ->send(new ContactUsForUser($info));
        if(Subscriber::where('email',$this->email)->count() == 0) {
            Subscriber::create([
                'email' => $this->email
            ]);
        }
        $this->reset(['email','name','message']);
        $this->formSubmitted = 'Mail has been sent.';
    }
    public function render()
    {
        return view('livewire.pages.components.contact-us');
    }
}
