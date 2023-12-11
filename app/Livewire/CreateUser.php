<?php

namespace App\Livewire;

use App\Models\Department;
use App\Models\Location;
use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CreateUser extends Component implements HasForms
{

    use InteractsWithForms;

    public ?array $data = [];

    public function mount()
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->required()
                    ->email(),
                TextInput::make('password')
                    ->required()
                    ->password()
                    ->autocomplete('new-password'),
                Select::make('departments')
                    ->multiple()
                    ->options(Department::all()->pluck('name', 'id')),
                Select::make('locations')
                    ->multiple()
                    ->options(Location::all()->pluck('name', 'id'))
            ])
            ->statePath('data');

    }

    public function create()
    {
        $formData = $this->form->getState();

        $departments = $formData['departments'];
        $locations = $formData['locations'];
        unset($formData['departments']);
        unset($formData['locations']);

        $user = User::create($formData);

        $user->departments()->attach($departments);
        $user->locations()->attach($locations);

        return redirect(route('users.index'));
    }

    public function render()
    {
        return view('livewire.create-user');
    }
}
