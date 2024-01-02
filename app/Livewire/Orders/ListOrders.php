<?php

namespace App\Livewire\Orders;

use App\Enums\OrderStatus;
use App\Models\Order;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;

class ListOrders extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Order::query())
            ->columns([
                Tables\Columns\TextColumn::make('number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        OrderStatus::PENDING => 'info',
                        OrderStatus::APPROVED => 'success',
                        OrderStatus::DECLINED => 'warning',
                        OrderStatus::CANCELLED, OrderStatus::COMPLETED => '',
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('payment_method')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('payment_reference')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('Status')
                    ->options([
                        OrderStatus::PENDING => 'Pending',
                        OrderStatus::APPROVED => 'Approved',
                        OrderStatus::DECLINED => 'Declined',
                        OrderStatus::CANCELLED => 'Cancelled',
                        OrderStatus::COMPLETED => 'Completed',
                    ])
            ])
            ->actions([
                Action::make('approve')
                    ->visible(fn($record) => $record->status == OrderStatus::PENDING)
//                    ->action(fn($record))
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.orders.list-orders');
    }
}
