<?php

namespace App\Livewire\User\Commande;

use App\Models\Order;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\WithPagination;
use Illuminate\Contracts\Pagination\Paginator;
use Filament\Tables\Actions\{BulkAction, Action};

class CommandeTable extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;


    protected function getTableQuery(): Builder
    {

        // $freelance = freelance::where('user_id', Auth::user()->id)->first();
        $user = auth()->user()->id;

        $order = Order::query();
        // Créer une requête pour la table "Service"
        $order->where('user_id', $user)->OrderBy('created_at', 'Desc')->with('feedback')->get();

        // Ajouter une condition pour l'utilisateur connecté

        // Retourner la requête
        return $order;
    }

    public function table(Table $table): Table
    {
        return $table

            ->query($this->getTableQuery())
            ->paginated([5, 25, 50, 100, 'all'])
            ->columns([
                Tables\Columns\TextColumn::make('order_numero')->label('order')->description('commande id'),
                Tables\Columns\TextColumn::make('total_amount')->label('Montant')
                ->money('usd', true)
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('service.title')->description('service')->visibleFrom('md'),
                Tables\Columns\TextColumn::make('progress')->label('progression')->toggleable(),
                Tables\Columns\TextColumn::make('feedback.etat')->label('Etat commande')->description('progression'),
                Tables\Columns\TextColumn::make('created_at')->label('Date Commande')
                ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\BadgeColumn::make('status')
                ->colors([
                    'primary',
                    'secondary' => 'pending',
                    'warning' => 'rejeted',
                    'success' => 'completed',

                ])
            ])->striped()
            ->filters([
                Filter::make('created_at')
                ->form([
                    DatePicker::make('created_from')->label('Du'),
                    DatePicker::make('created_until')->label('Au')->default(now()),
                ])->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['created_from'],
                            fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                        )
                        ->when(
                            $data['created_until'],
                            fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                        );
                }),


                SelectFilter::make('status')->label('Status Paiement')
                ->multiple()
                    ->options([
                        'pending' => 'En attente',
                        'rejeted' => 'rejeter',
                        'completed' => 'Complet',
                    ]),

                /*SelectFilter::make('state')->label('Status Paiement')
                ->multiple()
                ->relationship('feedback', 'state')
                ->options([
                    'En attente de traitement' => 'En attente de traitement',
                    'En cours de préparation' => 'En cours de préparation',
                    'En transit' => 'En transit',
                    'Livré' => 'Livré',
                ]),


                */
            ])
            ->actions([
            //

            Action::make('Voir')
                ->url(fn (Order $record): string => route('commandeOneView', $record->order_numero))
                // ->openUrlInNewTab()
                ->icon('heroicon-s-pencil')
                ->tooltip('Voir'),
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

    public function placeholder()
    {
        return <<<'HTML'
        <div>
           <div class="flex-1 w-full min-h-screen p-4 mb-2 overflow-y-auto text-xs bg-gray-200 border-r border-indigo-300 rounded-md dark:bg-gray-600 animate-pulse custom-scrollbar">



            </div>
        </div>
        HTML;
    }


    public function render(): View
    {
        return view('livewire.user.commande.commande-table');
    }
}
