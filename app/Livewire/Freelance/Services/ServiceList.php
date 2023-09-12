<?php

namespace App\Livewire\Freelance\Services;

use App\Models\Freelance;
use App\Models\Service;

use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Pagination\Paginator;
use Livewire\Attributes\{Layout, Title};
use Filament\Tables\Actions\ActionGroup;

#[Layout('layouts.freelance-layout')]
#[Title('Liste Service')]

class ServiceList extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    protected function getTableQuery(): Builder
    {

        $freelance = Freelance::where('user_id', Auth::user()->id)->first();

        // Créer une requête pour la table "Service"
        $service = Service::query();

        // Ajouter une condition pour l'utilisateur connecté
        $service->where('freelance_id', $freelance->id);

        // Retourner la requête
        return $service;
    }

    public function table(Table $table): Table
    {
        return $table
            ->query($this->getTableQuery())

            ->paginated([10, 25, 50, 100, 'all'])
            ->columns([
                Tables\Columns\TextColumn::make('service_numero')->label('ID')
            ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('title')->label('Titre')
                ->searchable(),
                Tables\Columns\TextColumn::make('basic_price')->money('usd', true)->label('Prix Basique'),
            Tables\Columns\TextColumn::make('premium_price')->money('usd', true)->label('Prix Premium')->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('extra_price')->money('usd', true)->label('Prix Extra')->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TagsColumn::make('tag')->label('Tag de recherche')
                ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('basic_delivery_time')
                ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\BooleanColumn::make('is_publish'),
                Tables\Columns\TextColumn::make('created_at')->label('Date de creation')
                ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                //
            ])
            ->filters([
                //
            ])
            ->actions([


                ActionGroup::make([
                    Action::make('Modifier')
                    ->url(fn (Service $record): string => route('freelance.service.edit', $record->service_numero))
                    ->icon('heroicon-s-pencil'),
                Action::make('voir')
                    // ->url(fn (Service $record): string => route('freelance.service.feedback', $record->service_numero))
                    ->icon('heroicon-s-eye'),
                Action::make('ajouter Niveau')
                    ->url(fn (Service $record): string => route('freelance.service.level', $record->service_numero))
                    ->icon('heroicon-s-eye'),
                    ])->label('Actions'),

                //
            ])
            ->headerActions([Action::make('Nouveau')
                 ->url(route('freelance.service.create'))
                ->icon('heroicon-s-plus'),

                ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    protected function paginateTableQuery(Builder $query): Paginator
    {
        return $query->simplePaginate($this->getTableRecordsPerPage() == 'all' ? $query->count() : $this->getTableRecordsPerPage());
    }

    public function render(): View
    {
        return view('livewire.freelance.services.service-list');
    }
}
