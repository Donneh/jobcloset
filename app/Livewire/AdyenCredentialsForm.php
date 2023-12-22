<?php

namespace App\Livewire;

use App\Enums\AdyenEnvironment;
use App\Models\AdyenSettings;
use App\Models\Tenant;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Livewire\Component;
use Illuminate\Contracts\View\View;

class AdyenCredentialsForm extends Component implements HasForms
{
    use InteractsWithForms;

    public Tenant $tenant;


    public ?array $data = [];

    public function mount()
    {
        $this->tenant = auth()->user()->tenant;
        $adyenSettings = $this->tenant->adyenSettings;

        if($adyenSettings) {
            $this->form->fill($adyenSettings->toArray());
        }
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make('Adyen Settings')
                ->schema([
                    Forms\Components\Select::make('environment')
                        ->options([
                            AdyenEnvironment::TEST->value => 'Test',
                            AdyenEnvironment::LIVE->value => 'Live',
                        ])
                        ->required(),
                    Forms\Components\TextInput::make('merchant_account')
                        ->label('Merchant Account')
                        ->required(),
                    Forms\Components\TextInput::make('api_key')
                        ->label('Api Key')
                        ->required(),
                    Forms\Components\TextInput::make('client_key')
                        ->label('Client Key')
                        ->required()
                ])
            ])
            ->statePath('data')
            ->model(AdyenSettings::class);
    }

    public function submit(): void
    {
        $data = $this->form->getState();

        $adyenSettings = $this->tenant->adyenSettings()->firstOrNew([]);

        if ($adyenSettings->exists) {
            $adyenSettings->update([
                'environment' => $data['environment'],
                'merchant_account' => $data['merchant_account'],
                'api_key' => $data['api_key'],
                'client_key' => $data['client_key'],
            ]);

        } else {
            $this->tenant->adyenSettings()->save(new AdyenSettings([
                'environment' => $data['environment'],
                'merchant_account' => $data['merchant_account'],
                'api_key' => $data['api_key'],
                'client_key' => $data['client_key'],
            ]));
        }

        Notification::make()
            ->title('Saved succesfully')
            ->success()
            ->send();
    }

    public function render(): View
    {
        return view('livewire.adyen-credentials-form');
    }
}
