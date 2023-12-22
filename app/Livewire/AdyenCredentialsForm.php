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
        $this->form->fill(auth()->user()->tenant->adyenSettings->toArray());
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
                        ]),
                    Forms\Components\TextInput::make('merchant_account')
                        ->label('Merchant Account'),
                    Forms\Components\TextInput::make('api_key')
                        ->label('Api Key'),
                    Forms\Components\TextInput::make('client_key')
                        ->label('Client Key')
                ])
            ])
            ->statePath('data')
            ->model(AdyenSettings::class);
    }

    public function submit(): void
    {
        $this->authorize('update', $this->tenant->adyenSettings);

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
