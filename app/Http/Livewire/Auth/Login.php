<?php

namespace App\Http\Livewire\Auth;

use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;

    public function render()
    {
        return view('livewire.auth.login');
    }

    public function login()
    {
        Notification::make()->title('test')->success()->duration(0)->send();

        // $this->validate([
        //     'email' => 'required|email',
        //     'password' => 'required'
        // ]);

        // if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {

        // }


        // dd($this->email, $this->password);
    }
}
