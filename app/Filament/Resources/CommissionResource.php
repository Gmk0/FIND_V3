<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommissionResource\Pages;
use App\Filament\Resources\CommissionResource\RelationManagers;
use App\Models\Commission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CommissionResource extends Resource
{
    protected static ?string $model = Commission::class;

    protected static ?string $navigationGroup = 'Paiement';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('order_id')
                    ->relationship('order', 'id'),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\Select::make('mission_id')
                    ->relationship('mission', 'title'),
                Forms\Components\TextInput::make('amount')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('net_amount')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('percent')
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->groups([
            'order.status',
            'mission.status',
            ])
            ->defaultGroup('order.status')
            ->columns([
                Tables\Columns\TextColumn::make('order.order_numero')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('mission.mission_numero')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount')
                    ->money('usd', true)
                ->summarize([
                    Tables\Columns\Summarizers\Sum::make()
                        ->money(),
                ]),

                Tables\Columns\TextColumn::make('net_amount')
            ->money('usd', true)
            ->summarize([
                Tables\Columns\Summarizers\Sum::make()
                    ->money(),
            ])
                    ->sortable(),
                Tables\Columns\TextColumn::make('percent')
                    ->searchable(),
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
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListCommissions::route('/'),
            'create' => Pages\CreateCommission::route('/create'),
            'view' => Pages\ViewCommission::route('/{record}'),
            'edit' => Pages\EditCommission::route('/{record}/edit'),
        ];
    }
}
