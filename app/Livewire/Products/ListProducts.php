<?php

namespace App\Livewire\Products;

use App\Http\Controllers\ProductController;
use App\Models\Product;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;

class ListProducts extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Product::query())
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('Image')
                    ->height(75),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->icon('heroicon-m-currency-euro'),
                Tables\Columns\TextColumn::make('stock'),
                Tables\Columns\TextColumn::make('departments.name')
                    ->limitList(3),
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
                //
            ])
            ->actions([
                EditAction::make('Update')
                    ->form([
                        TextInput::make('name')
                            ->required()
                            ->unique(Product::class, ignoreRecord: true),
                        Textarea::make('description'),
                        FileUpload::make('image_path')
                            ->image()
                            ->imageEditor(),
                        TextInput::make('price')
                            ->numeric()
                            ->inputMode('decimal')
                            ->minValue(0)
                            ->prefix('€'),
                        TextInput::make('stock')
                            ->numeric()
                            ->minValue(0),
                        Select::make('department_id')
                            ->multiple()
                            ->relationship('departments', 'name')
                            ->preload(),
                        Repeater::make('attributes')
                            ->columns(2)
                            ->relationship()
                            ->schema([
                                TextInput::make('name')
                                    ->placeholder('E.g. Size'),
                                TagsInput::make('options')
                                    ->placeholder("E.g. Small, medium or large")
                                    ->model('')
                            ])
                    ]),
                DeleteAction::make()
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->form([
                        TextInput::make('name')
                            ->required()
                            ->unique(Product::class, ignoreRecord: true),
                        Textarea::make('description'),
                        FileUpload::make('image_path')
                            ->image()
                            ->imageEditor(),
                        TextInput::make('price')
                            ->numeric()
                            ->inputMode('decimal')
                            ->minValue(0)
                            ->prefix('€'),
                        TextInput::make('stock')
                            ->numeric()
                            ->minValue(0),
                        Select::make('department_id')
                            ->multiple()
                            ->relationship('departments', 'name')
                            ->preload(),
                        Repeater::make('attributes')
                            ->relationship()
                            ->columns(2)
                            ->schema([
                                TextInput::make('name')
                                    ->placeholder('E.g. Size'),
                                TagsInput::make('options')
                                    ->placeholder("E.g. Small, medium or large")
                            ])
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
        return view('livewire.products.list-products');
    }
}
