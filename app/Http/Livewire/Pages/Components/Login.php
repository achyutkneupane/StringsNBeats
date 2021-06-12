<?php

namespace App\Http\Livewire\Pages\Components;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        $user = User::where('email',$this->email)->first();
        if(Hash::check($this->password, $user->password)) {
            Auth::loginUsingId($user->id);
            redirect()->route('homepage');
        }
        else {
            $this->addError('password','You have entered wrong password.');
        }
    }
    public function render()
    {
        return view('livewire.pages.components.login');
    }
}
