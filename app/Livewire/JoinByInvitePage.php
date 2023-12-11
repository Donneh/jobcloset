<?php

namespace App\Livewire;

use App\Mail\UserCreated;
use App\Models\User;
use App\Models\UserInvite;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Component;


class JoinByInvitePage extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];
    public UserInvite $invite;
    public string $token;

    public function mount(string $token)
    {
        $this->token = $token;
        $this->invite = UserInvite::where('token', $token)->first();
        $this->form->fill(['email' => $this->invite->email]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->model(User::class)
            ->schema([
                TextInput::make('email')
                    ->disabled()
                    ->required(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('password')
                    ->password()
                    ->required(),
                Select::make('department_id')
                    ->multiple()
                    ->relationship('departments', 'name')
                    ->preload(),
                Select::make('location_id')
                    ->multiple()
                    ->relationship('locations', 'name')
                    ->preload()

            ])
            ->statePath('data');
    }

    public function create()
    {
        $invite = UserInvite::where('token', $this->token)
            ->where('email', $this->data['email'])
            ->first();

        if (is_null($invite)) {
            return back()->withErrors(['email' => 'Invalid email or token.']);
        }

        $user = User::create([
            'email' => $this->data['email'],
            'name' => $this->data['name'],
            'password' => Hash::make($this->data['password']),
            'tenant_id' => $invite->tenant_id
        ]);

        $user->departments()->sync($this->data['department_id']);
        $user->locations()->sync($this->data['location_id']);

        Auth::login($user);

        $invite->delete();

        \Mail::to($user->email)->send(new UserCreated($user));

        return redirect()->route('shop.index');
    }

    #[Layout('components.layouts.guest')]
    public function render()
    {
        return view('livewire.join-by-invite-page');
    }
}
