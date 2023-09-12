<?php

namespace App\Livewire\Freelance\Mission;

use App\Models\Mission;
use App\Models\MissionResponse;

use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Actions\Action as ActionsAction;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;


use Filament\Tables\Actions\{BulkAction, Action};

use Livewire\Attributes\{Layout, Title};


#[Layout('layouts.freelance-layout')]
#[Title('Freelance Mission')]

class MissionEnCours extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;


    protected function getTableQuery(): Builder
    {
        $freelance = auth()->user()->getIdFreelance();

        $ProjectResponse = MissionResponse::query();
        $ProjectResponse->where('freelance_id', $freelance)->where('status', 'approved');

        return $ProjectResponse;
    }
    public function table(Table $table): Table
    {
        return $table
            ->query($this->getTableQuery())
            ->columns([
            Tables\Columns\TextColumn::make('mission.user.name')->label('client')
                ->toggleable(isToggledHiddenByDefault: false),
            Tables\Columns\TextColumn::make('mission.title')->label('Titre'),
            Tables\Columns\TextColumn::make('budget')->money('usd', true)->label('budget'),

              Tables\Columns\BadgeColumn::make('mission.status')
            ->toggleable(isToggledHiddenByDefault: true),

            Tables\Columns\BadgeColumn::make('mission.feedbackmission.etat')
                ->colors([
                    'secondary' => 'pending',
                    'warning' => 'rejeted',
                    'success' => 'completed',

                ]),
            Tables\Columns\BooleanColumn::make('is_paid')->toggleable(isToggledHiddenByDefault: true),

                //
            ])
            ->filters([

                //
            ])
            ->actions([
                Action::make('Voir')
                ->url(fn (MissionResponse $record): string => route('freelance.proposition.accepted', $record->mission->mission_numero))
                // ->openUrlInNewTab()
                ->icon('heroicon-s-pencil')
                ->tooltip('Voir'),
                //
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.freelance.mission.mission-en-cours');
    }
}
