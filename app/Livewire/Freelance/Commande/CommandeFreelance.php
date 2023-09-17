<?php

namespace App\Livewire\Freelance\Commande;


use App\Models\Order;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;

use Filament\Forms\Get;
use Filament\Tables\Actions\{BulkAction, Action};
use Illuminate\Support\Collection;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms;
use Livewire\Attributes\{Layout, Title};
use Filament\Tables\Actions\ActionGroup;
use Illuminate\Contracts\Pagination\Paginator;

#[Layout('layouts.freelance-layout')]
#[Title('Freelance Commande')]

class CommandeFreelance extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;


    protected function getTableQuery(): Builder
    {

        // $freelance = freelance::where('user_id', Auth::user()->id)->first();
        $freelance = auth()->user()->freelance->id;

        $order = Order::query();
        // Créer une requête pour la table "Service"
        $order->whereHas('service.freelance', function ($query) use ($freelance) {
            $query->where('id', $freelance);
        })->orderBy('created_at', 'Desc')->get();

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
                Tables\Columns\TextColumn::make('order_numero')->label('order'),
                Tables\Columns\TextColumn::make('service.title')->description('service')->visibleFrom('md'),
                Tables\Columns\TextColumn::make('progress'),
            Tables\Columns\TextColumn::make('feedback.etat'),

                Tables\Columns\TextColumn::make('total_amount')->money('usd', true),

                Tables\Columns\BadgeColumn::make('status')
                ->colors([
                    'primary',
                    'secondary' => 'pending',
                    'warning' => 'rejeted',
                    'success' => 'completed',

                ]),









                //
            ])
            ->filters([Filter::make('created_at')
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

            ])
            ->actions([
                Action::make('Gerer')
                ->url(fn (Order $record): string => route('freelance.Order.view', $record->order_numero))
                    // ->openUrlInNewTab()
                    ->icon('heroicon-s-pencil')
                    ->tooltip('Voir les services'),
                //
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
        return view('livewire.freelance.commande.commande-freelance', [
            'payer' => Order::whereHas('service', function ($query) {
                $query->where('freelance_id', auth()->user()->freelance->id);
            })->where('status', 'completed')->count(),
            'pending' => Order::whereHas('service', function ($query) {
                $query->where('freelance_id', auth()->user()->freelance->id);
            })->where('status', 'pending')->count(),
            'rejeted' => Order::whereHas('service', function ($query) {
                $query->where('freelance_id', auth()->user()->freelance->id);
            })->where('status', '')->count(),
        ]);
    }
}
