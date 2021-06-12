<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;

class Login extends Component
{
    public $email,$password;
    public function validation()
    {
        $this->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ],[
            'exists' => "This :attribute doesn't exist in our system"
        ],[
            'email' => '<b>Email Address</b>',
            'password' => '<b>Password</b>'
        ]);
    }
    public function signIn()
    {
        $this->validation();
    }
    public function render()
    {
        return view('livewire.pages.login');
    }
}
