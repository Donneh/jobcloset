<?php

namespace App\Livewire\Auth;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;

class LoginPage extends Component
{

    public $email;
    public $password;

    public function submit()
    {
        $credentials = $this->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if(auth()->attempt([
            'email' => $this->email,
            'password' => $this->password
        ])) {
            return redirect()->intended('/');
        } else {
            $this->addError('email', 'Invalid email or password');
        }
    }

    public function render()
    {
        return view('livewire.auth.login-page');
    }
}
