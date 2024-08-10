<?php

namespace App\Filament\Widgets;

use App\Models\Tasks;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            //
            Stat::make('Total Tasks', Tasks::count()),
        ];
    }
}
