<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FreelanceResource\Pages;
use App\Filament\Resources\FreelanceResource\RelationManagers;
use App\Models\Freelance;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FreelanceResource extends Resource
{
    protected static ?string $model = Freelance::class;
    protected static ?string $navigationGroup = 'Freelances';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required(),
                Forms\Components\TextInput::make('nom')
                    ->required(),
                Forms\Components\TextInput::make('prenom')
                    ->required(),
                Forms\Components\TextInput::make('identifiant')
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('experience')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('langue')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('diplome')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('certificat')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('site'),
                Forms\Components\Textarea::make('competences')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('taux_journalier')
                    ->numeric(),
                Forms\Components\Textarea::make('comptes')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('sub_categorie')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('localisation')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('level')
                    ->required(),
                Forms\Components\TextInput::make('solde')
                    ->required()
                    ->numeric(),
                Forms\Components\Textarea::make('realisations')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nom')
                    ->searchable(),
                Tables\Columns\TextColumn::make('prenom')
                    ->searchable(),
                Tables\Columns\TextColumn::make('identifiant')
                    ->searchable(),
                Tables\Columns\TextColumn::make('site')
                    ->searchable(),
                Tables\Columns\TextColumn::make('taux_journalier')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('level')
                    ->searchable(),
                Tables\Columns\TextColumn::make('solde')
                    ->numeric()
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
            'index' => Pages\ListFreelances::route('/'),
            'create' => Pages\CreateFreelance::route('/create'),
            'view' => Pages\ViewFreelance::route('/{record}'),
            'edit' => Pages\EditFreelance::route('/{record}/edit'),
        ];
    }
}
