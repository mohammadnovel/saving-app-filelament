<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Filament\Resources\TransactionResource\RelationManagers;
use App\Models\Transaction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Actions\EditAction;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Select::make('category_id')
                ->relationship('category', 'name')
                ->required(),
            Select::make('type')
                ->options([
                    'income' => 'Pemasukan',
                    'expense' => 'Pengeluaran',
                    'saving' => 'Tabungan',
                ])
                ->required()
                ->label('Transaction Type'),
            TextInput::make('amount')
                ->numeric()
                ->required(),
            Textarea::make('description')
                ->nullable(),
            DatePicker::make('date')
                ->required(),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            // Category Column
            Tables\Columns\TextColumn::make('category.name')
                ->label('Category')
                ->searchable(),

            // Transaction Type Column using SelectColumn
            SelectColumn::make('type')
                ->options([
                    'income' => 'Pemasukan',
                    'expense' => 'Pengeluaran',
                    'saving' => 'Tabungan',
                ])
                ->label('Transaction Type')
                ->sortable()
                ->searchable(),

            // Amount Column
            Tables\Columns\TextColumn::make('amount')
                ->label('Amount')
                ->sortable(),

            // Description Column
            Tables\Columns\TextColumn::make('description')
                ->limit(50)
                ->label('Description'),

            // Date Column
            Tables\Columns\TextColumn::make('date')
                ->label('Date')
                ->sortable(),
        ])
        ->filters([
            // Tambah filter jika perlu
        ])
        ->actions([
            // Edit action
            EditAction::make(),
            // Delete action
            DeleteAction::make(),
        ])
        ->bulkActions([
            // Bulk delete action
            Tables\Actions\DeleteBulkAction::make(),
        ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }
    
}
