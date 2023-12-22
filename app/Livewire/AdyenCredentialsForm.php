<?php

namespace App\Livewire;

use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Illuminate\Contracts\View\View;

class AdyenCredentialsForm extends Component implements HasForms
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
                Forms\Components\Fieldset::make('Adyen Settings')
                ->schema([
                    Forms\Components\Select::make('Environment')
                        ->options(['test']),
                    Forms\Components\TextInput::make('Merchant Account'),
                    Forms\Components\TextInput::make('Api Key'),
                    Forms\Components\TextInput::make('Client key')
                ])
            ])
            ->statePath('data');
    }

    public function submit(): void
    {
        $data = $this->form->getState();

        //
    }

    public function render(): View
    {
        return view('livewire.adyen-credentials-form');
    }
}
