<?php

namespace App\Filament\Widgets;

use App\Models\Tasks;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class Top10UserTasksChart extends ChartWidget
{
    protected static ?string $heading = 'Top 10 Users have number of tasks';

    protected function getData(): array
    {
        $topUsers = Tasks::select('assigned_to_id', DB::raw('count(*) as total_tasks'))
            ->groupBy('assigned_to_id')
            ->orderBy('total_tasks', 'desc')
            ->limit(10)
            ->with('assignedTo')
            ->get();
        $labels = $topUsers->pluck('assignedTo.name')->toArray();
        $data = $topUsers->pluck('total_tasks')->toArray();
        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Number of Tasks',
                    'data' => $data,
                    'backgroundColor' => [
                        '#FF6384',
                        '#36A2EB',
                        '#FFCE56',
                        '#4BC0C0',
                        '#9966FF',
                        '#FF9F40',
                        '#FF6384',
                        '#36A2EB',
                        '#FFCE56',
                        '#4BC0C0',
                    ],
                    'hoverBackgroundColor' => [
                        '#FF6384',
                        '#36A2EB',
                        '#FFCE56',
                        '#4BC0C0',
                        '#9966FF',
                        '#FF9F40',
                        '#FF6384',
                        '#36A2EB',
                        '#FFCE56',
                        '#4BC0C0',
                    ],
                ],
            ],
        ];
    }


    protected function getType(): string
    {
        return 'pie';
    }
}
