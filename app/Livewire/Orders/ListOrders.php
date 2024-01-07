<?php

namespace App\Livewire\Orders;

use App\Enums\OrderStatus;
use App\Events\OrderApproved;
use App\Events\OrderCompleted;
use App\Events\OrderDeclined;
use App\Events\OrderPaid;
use App\Models\Order;
use App\Services\PaymentService;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
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
                Tables\Columns\BadgeColumn::make('status')
                    ->color(fn(string $state): string => match ($state) {
                        OrderStatus::PENDING => 'info',
                        OrderStatus::APPROVED, OrderStatus::COMPLETED, OrderStatus::PAID => 'success',
                        OrderStatus::DECLINED => 'warning',
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('total price')
                    ->money('EUR')
                    ->state(fn($record) => $record->getTotal()),
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
                        OrderStatus::COMPLETED => 'Completed',
                        OrderStatus::PAID => 'Paid',
                    ])
            ])
            ->actions([
                ActionGroup::make([
                    Action::make('view')->modalFooterActions([])
                        ->infolist([
                            Section::make('Order Information')
                                ->schema([
                                    TextEntry::make('Order Number')->state(fn($record) => $record->number),
                                    TextEntry::make('Ordered by ')->state(fn($record) => $record->user->name . ' (' . $record->user->email . ')'),
                                    TextEntry::make('Status')
                                        ->badge()
                                        ->color(fn(string $state): string => match ($state) {
                                            OrderStatus::PENDING => 'info',
                                            OrderStatus::APPROVED, OrderStatus::PAID => 'success',
                                            OrderStatus::DECLINED => 'warning',
                                            OrderStatus::COMPLETED => 'white',
                                        })
                                        ->state(fn($record) => $record->status),
                                    TextEntry::make('Total Price')->state(fn($record) => $record->getTotal())->money('EUR'),
                                    TextEntry::make('Created At')->state(fn($record) => $record->created_at)->dateTime()->label('Ordered At'),
                                ])
                                ->columns(),
                            Section::make('Ordered Items')
                                ->schema([
                                    RepeatableEntry::make('orderItems')
                                        ->schema([
                                            TextEntry::make('Product Name')->state(fn($record) => $record->name),
                                            TextEntry::make('Quantity')->state(fn($record) => $record->quantity),
                                            TextEntry::make('Price')->state(fn($record) => $record->price)->money('EUR'),
                                            TextEntry::make('Total Price')->state(fn($record) => $record->price * $record->quantity)->money('EUR'),
                                        ])
                                        ->columns(4)
                                ])
                        ])
                    ,
                    Action::make('decline')
                        ->visible(fn($record) => $record->status == OrderStatus::PENDING || $record->status == OrderStatus::APPROVED)
                        ->action(fn($record) => OrderDeclined::fire($record->id)),
                    Action::make('approve')
                        ->visible(fn($record) => $record->status == OrderStatus::PENDING)
                        ->action(fn($record) => OrderApproved::fire($record->id)),
                    Action::make('complete')
                        ->visible(fn($record) => $record->status == OrderStatus::APPROVED || $record->status == OrderStatus::PAID)
                        ->action(fn($record) => OrderCompleted::fire($record->id)),
                ])
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
