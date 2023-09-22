<?php

namespace App\Livewire\Freelance\Dashboard;

use App\Models\Order;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\Paginator;
use Filament\Tables\Actions\{BulkAction, Action};
use App\Events\OrderCreated;


class CommandeTableFreelance extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function  getListeners()
    {

        $auth_id = auth()->user()->id;
        return [
            // "echo-private:notify.{$auth_id},ProjectResponse" => 'broadcastedMessageReceived',
            "echo-private:notify.{$auth_id},OrderCreated" => '$refresh',
            // 'ServiceOrdered' => '$refresh',


        ];
    }

    protected function getTableQuery(): Builder
    {
        // $freelance = freelance::where('user_id', Auth::user()->id)->first();
        $freelance = auth()->user()->freelance->id;

        $order = Order::query();
        // Créer une requête pour la table "Service"
        $order->whereHas('service', function ($query) use ($freelance) {
            $query->where('freelance_id', $freelance);
        })->orderBy('created_at', 'Desc')->get();

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

            Tables\Columns\TextColumn::make('status')
            ->badge()
            ->color(fn (string $state): string => match ($state) {

                'completed' => 'success',
                'pending' => 'warning',
                'failed' => 'danger',
            })
            , Tables\Columns\TextColumn::make('is_paid')->label('Verser')
                ->dateTime(),


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





            ])
            ->actions([
            //

            Action::make('Voir')
            ->url(fn (Order $record): string => route('freelance.Order.view', $record->order_numero))
            // ->openUrlInNewTab()
            ->icon('heroicon-s-pencil')
            ->tooltip('Voir les services'),
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
        return view('livewire.freelance.dashboard.commande-table-freelance');
    }
}
