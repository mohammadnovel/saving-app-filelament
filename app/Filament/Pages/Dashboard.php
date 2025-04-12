<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    public function getHeaderWidgets(): array
    {
        return [];
    }
    
    public function getWidgets(): array
    {
        return [
            \App\Filament\Widgets\FinanceOverview::class,
            \App\Filament\Widgets\ExpenseLineChart::class,
            \App\Filament\Widgets\IncomeBarChart::class, // Bar chart tambahan

        ];
    }

    public function getColumns(): int | array
    {
        return 2; // agar chart tampil di satu baris
    }

   
}
