<?php

namespace App\Livewire;

use App\Mail\UserInvited;
use App\Models\Department;
use App\Models\User;
use App\Models\UserInvite;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use function Clue\StreamFilter\fun;

class UserList extends Component implements HasForms, HasTable
{

    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(User::query())
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make('Update')
                    ->form([
                        TextInput::make('name')
                            ->required(),
                        TextInput::make('email')
                            ->required()
                            ->email(),
                        TextInput::make('password')
                            ->required()
                            ->password()
                            ->autocomplete('new-password'),
                        Select::make('department_id')
                            ->multiple()
                            ->relationship('departments', 'name')
                            ->preload(),
                        Select::make('location_id')
                            ->multiple()
                            ->relationship('locations', 'name')
                            ->preload()
                    ]),
                DeleteAction::make('delete')

                    ->requiresConfirmation()
                    ->action(fn(User $record) => $record->delete()),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->form([
                        TextInput::make('name')
                            ->required(),
                        TextInput::make('email')
                            ->required()
                            ->email(),
                        TextInput::make('password')
                            ->required()
                            ->password()
                            ->autocomplete('new-password'),
                        Select::make('department_id')
                            ->multiple()
                            ->relationship('departments', 'name'),
                        Select::make('location_id')
                            ->multiple()
                            ->relationship('locations', 'name')
                    ]),
                Tables\Actions\Action::make('userInvite')
                    ->model(UserInvite::class)
                    ->form([
                        TextInput::make('email')
                            ->email()
                            ->required()
                    ])
                    ->label('Invite user')
                    ->icon('heroicon-m-pencil-square')
                    ->color('info')
                    ->action(function ($data) {
                        $invite = new UserInvite();
                        $invite->email = $data['email'];
                        $invite->token = \Str::random(12);
                        $invite->save();
                        \Mail::to($data['email'])
                            ->send(new UserInvited($invite));
                    })
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    public function render()
    {
        return view('livewire.user-list');
    }

}
