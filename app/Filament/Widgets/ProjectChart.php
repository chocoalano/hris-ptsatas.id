<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class ProjectChart extends ChartWidget
{
    protected static ?string $heading = 'Project Analytic';

    protected function getData(): array
    {
        $q = \App\Models\Project\ProjectManagement::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(DB::raw("Month(created_at)"))
                    ->pluck('count', 'month_name');
                    $labels = $q->keys();
                    $data = $q->values();                    
        return [
            'datasets' => [
                [
                    'label' => 'Project Analytic',
                    'data' => $data,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
