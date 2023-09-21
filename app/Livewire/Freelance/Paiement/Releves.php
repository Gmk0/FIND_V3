<?php

namespace App\Livewire\Freelance\Paiement;

use App\Models\Transaction;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;

use Livewire\Attributes\{Layout, Title};
use Filament\Forms;

use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
 use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Actions\Action;


#[Layout('layouts.freelance-layout')]
#[Title('Paiement effectuer')]

class Releves extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public $solde;

    public function mount()
    {
        $this->solde= auth()->user()->freelance->solde;
    }
    protected function getTableQuery(): Builder
    {

        // $freelance = freelance::where('user_id', Auth::user()->id)->first();
        $user = auth()->user()->id;

        $transaction = Transaction::query();
        // Créer une requête pour la table "Service"
        $transaction->where('user_id', $user)->OrderBy('created_at', 'Desc')->get();

        // Ajouter une condition pour l'utilisateur connecté

        // Retourner la requête
        return $transaction;
        // Créer une requête pour la table "Service"


        // Ajouter une condition pour l'utilisateur connecté

        // Retourner la requête
        return $transaction;
    }

    public function table(Table $table): Table
    {
        return $table
            ->query($this->getTableQuery())
            ->groups([
                'status',
                'type',
            ])
            ->defaultGroup('type')
            ->columns([Tables\Columns\TextColumn::make('transaction_numero')->label('ID'),
            Tables\Columns\TextColumn::make('amount')->money('usd', true)
                ->summarize(Sum::make()->money('usd', true)),
            Tables\Columns\TextColumn::make('type')
                ->toggleable(isToggledHiddenByDefault: false),
            Tables\Columns\TagsColumn::make('payment_method')
            ,
            Tables\Columns\TextColumn::make('created_at')->label('Date transaction')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: false),
            Tables\Columns\TextColumn::make('status')
            ->badge()
                ->colors([
                    'primary',
                    'secondary' => 'pending',
                    'warning' => 'rejeted',
                    'success' => 'completed',

                ])
            ])
            ->filters([
            //

            Filter::make('created_at')
                ->form([
                    Forms\Components\DatePicker::make('created_from')->label('Du'),
                    Forms\Components\DatePicker::make('created_until')->label('Au')->default(now()),
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
            SelectFilter::make('type')->label('Typoe Transaction')
            ->multiple()
                ->options([
                    'paiement' => 'paiement',
                    'debit' => 'debit',
                    'credit' => 'credit',
                ]),
            ])->filtersFormColumns(3)
            ->actions([
                //
            ])->headerActions([
                Action::make('Exporter')
                    ->url(route('freelance.transaction.export',auth()->id()))
                    ->icon('heroicon-s-printer'),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    public function render(): View
    {
        $baseQuery = Transaction::where('user_id', auth()->id())->where('status', 'completed');


        $debitsQuery = clone $baseQuery;
        $creditsQuery = clone $baseQuery;
        $paymentsQuery = clone $baseQuery;

        return view('livewire.freelance.paiement.releves', [
            'debits' => $debitsQuery->where('type', '=', 'debit')->sum('amount'),
            'credits' => $creditsQuery->where('type', '=', 'credit')->sum('amount'), // Assurez-vous que c'est bien 'credit' et non 'debit'
            'paiments' => $paymentsQuery->where('type', '=', 'paiement')->sum('amount'), // Assurez-vous que c'est bien 'payment' et non 'debit'
        ]);
    }

}
