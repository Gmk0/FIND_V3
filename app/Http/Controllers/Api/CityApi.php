<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Localisation;
use Illuminate\Http\Request;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class CityApi extends Controller
{
    //

    public function __invoke(Request $request): Collection
    {
        return Localisation::query()
            ->select('id', 'ville')
            ->orderBy('ville')
            ->when(
                $request->search,
                fn (Builder $query) => $query
                    ->where('ville', 'like', "%{$request->search}%")

            )
            ->when(
                $request->exists('selected'),
                fn (Builder $query) => $query->whereIn('id', $request->input('selected', [])),
                fn (Builder $query) => $query->limit(10)
            )
            ->get();
    }
    //
}
