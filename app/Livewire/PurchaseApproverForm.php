<?php

namespace App\Livewire;

use App\Models\Tenant;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Illuminate\Contracts\View\View;

class PurchaseApproverForm extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount()
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        $tenant = Tenant::find(auth()->user()->tenant_id);
        return $form
            ->schema([
                Forms\Components\Fieldset::make('Who should approve purchases?')
                    ->schema([
                        Forms\Components\Select::make('approver_id')
                            ->relationship(name: "jobtitles",   titleAttribute: "name")
                    ])
            ])
            ->statePath('data')
            ->model($tenant);
    }

    public function submit(): void
    {
        $data = $this->form->getState();

        //
    }

    public function render(): View
    {
        return view('livewire.purchase-approver-form');
    }
}
