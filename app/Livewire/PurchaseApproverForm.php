<?php

namespace App\Livewire;

use App\Models\Tenant;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Livewire\Component;
use Illuminate\Contracts\View\View;

class PurchaseApproverForm extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount()
    {
        $tenant = auth()->user()->tenant;

        if($tenant && $tenant->approver_id)
        {
            $this->form->fill([
                'approver_id' => $tenant->approver_id,
            ]);
        }
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make('Who should approve purchases?')
                    ->schema([
                        Forms\Components\Select::make('approver_id')
                            ->relationship(name: "jobtitles",   titleAttribute: "name")
                    ])
            ])
            ->statePath('data')
            ->model(Tenant::class);
    }

    public function submit(): void
    {
        $data = $this->form->getState();

        auth()->user()->tenant->update([
            'approver_id' => $data['approver_id']
        ]);

        Notification::make()
            ->title('Success')
            ->body('Purchase approver has been set successfully.')
            ->success()
            ->send();
    }

    public function render(): View
    {
        return view('livewire.purchase-approver-form');
    }
}
