<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ProjectStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $pclear=\App\Models\Project\ProjectManagement::where(function ($query){
            $query
            ->where('progress', '=', 100)
            ->whereYear('created_at', date('Y'));
        })->count();
        $ptotal=\App\Models\Project\ProjectManagement::whereYear('created_at', date('Y'))->count();
        $punclear=\App\Models\Project\ProjectManagement::where(function ($query){
            $query
            ->where('progress', '<', 100)
            ->whereYear('created_at', date('Y'));
        })->count();
        $puntotal=\App\Models\Project\ProjectManagement::whereYear('created_at', date('Y'))->count();
        $custtotal=\App\Models\Sales\Customer::whereYear('created_at', date('Y'))->count();
        return [
        Stat::make('Total Project Compleate', $pclear)
            ->description('From total projects '.$ptotal)
            ->descriptionIcon('heroicon-m-rectangle-stack')
            ->color('success')
            ->chart([5,4,5,6,7,6,4,3,3,2,]),
        Stat::make('Total Project Uncompleate', $punclear)
            ->description('From total projects '.$puntotal)
            ->descriptionIcon('heroicon-m-rectangle-stack')
            ->color('danger')
            ->chart([5,4,5,6,7,6,4,3,3,2,]),
        Stat::make('Total Customers', $custtotal)
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('success')
            ->chart([5,4,5,6,7,6,4,3,3,2,]),
        ];
    }
}
