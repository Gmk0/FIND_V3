<?php

namespace App\Livewire\User\Transaction;

use Livewire\Component;

use Livewire\Attributes\{Layout, Title};
use App\Models\Transaction;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\{TagsColumn, BadgeColumn};
use Filament\Tables\Actions\{BulkAction, Action};

use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms;



#[Layout('layouts.user-layout')]

#[Title('Transaction')]
class TransactionList extends Component

implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;
    public $title = "Mes Transactions";

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
    }

    public function table(Table $table): Table
    {
        return $table
            ->query($this->getTableQuery())
            ->columns([
                Tables\Columns\TextColumn::make('transaction_numero')->label('ID'),
                Tables\Columns\TextColumn::make('amount')->money('usd', true),
            Tables\Columns\TextColumn::make('type')
            ->toggleable(isToggledHiddenByDefault: false),
                TagsColumn::make('payment_method'),
                Tables\Columns\TextColumn::make('created_at')->label('Date transaction')
                ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                BadgeColumn::make('status')
                ->colors([
                    
                    'secondary' => 'pending',
                    'warning' => 'failed',
                'primary' => 'completed',

                ])

                //
            ])
            ->filters([
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


                Action::make('Voir')
                ->url(fn (Transaction $record): string => route('transactionOneUser', $record->transaction_numero))
                    // ->openUrlInNewTab()
                    ->icon('heroicon-s-pencil')
                    ->tooltip('Voir transaction'),

            Action::make('Facture')
                ->url(fn (Transaction $record): string => route('facturation', $record->transaction_numero))
                    ->openUrlInNewTab()
                    ->icon('heroicon-s-pencil')
                    ->tooltip('Facture'),

    
                //

                //
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    public function render()
    {
        return view('livewire.user.transaction.transaction-list');
    }
}
