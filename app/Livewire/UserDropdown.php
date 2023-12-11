<?php

namespace App\Livewire;

use Livewire\Component;

class UserDropdown extends Component
{

    public function signOut()
    {
        auth()->logout();

        $this->redirectRoute('login');
    }

    public function openProfile()
    {
        return view('livewire.user-profile');
    }

    public function render()
    {
        return view('livewire.user-dropdown');
    }
}
