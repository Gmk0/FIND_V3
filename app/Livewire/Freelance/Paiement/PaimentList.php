<?php

namespace App\Livewire\Freelance\Paiement;

use App\Models\Commission;
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
use Filament\Tables\Actions\Action;




#[Layout('layouts.freelance-layout')]
#[Title('Paiement effectuer')]
class PaimentList extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;


    public function mount()
    {

    }
    protected function getTableQuery(): Builder
    {

        // $freelance = freelance::where('user_id', Auth::user()->id)->first();
        $user_id = auth()->user()->id;

        $order = Commission::query();
        // Créer une requête pour la table "Service"
        $order->where('user_id', $user_id)
        ->orderBy('created_at', 'Desc')->get();

        // Ajouter une condition pour l'utilisateur connecté

        // Retourner la requête
        return $order;
    }
    public function table(Table $table): Table
    {
        return $table
            ->query($this->getTableQuery())
            ->paginated([10, 25, 50, 100, 'all'])

            ->columns([

            Tables\Columns\TextColumn::make('order.order_numero')->label('commande'),
            Tables\Columns\TextColumn::make('mission.mission_numero')->label('Mission'),
            Tables\Columns\TextColumn::make('net_amount')->label('Montant percu')->money('usd',true)
                ->summarize([
                    Tables\Columns\Summarizers\Sum::make()
                        ->money(),
                ]),

                Tables\Columns\TextColumn::make('amount')->label('Commission')->money('usd', true),
            Tables\Columns\TextColumn::make('percent')->label('Pourcentage'),
            Tables\Columns\TextColumn::make('created_at')->label('Date Paiment ')
            ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: false),



                //
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
            ])
            ->actions([
            //
            Action::make('voir')
                //  //->url(fn (transaction $record): string => route('freelance.Order.view', $record->order_numero))

                ->icon('heroicon-s-eye')
                ->tooltip('Voir'),
            ])
            ->headerActions([
                Action::make('Exporter')
                    ->url(route('freelance.transaction.export', auth()->id()))
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
        return view('livewire.freelance.paiement.paiment-list');
    }
}
