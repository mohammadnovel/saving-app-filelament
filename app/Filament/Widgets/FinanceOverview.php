<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use App\Models\Saving;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class FinanceOverview extends BaseWidget
{
    public static function getSort(): int
    {
        return 1; // Tampil paling atas
    }

    public static function getDefaultColumnSpan(): int | string | array
    {
        return 'full'; // ⬅️ Ini akan membuat widget jadi 1 baris penuh
    }

    protected function getCards(): array
    {
        $totalSavings = Saving::sum('target_amount');
        $totalExpenses = Transaction::where('type', 'expense')->sum('amount');
        $balance = $totalSavings - $totalExpenses;

        return [
            Card::make('Total Tabungan', 'Rp. ' . number_format($totalSavings, 0, ',', '.')),
            Card::make('Total Pengeluaran', 'Rp. ' . number_format($totalExpenses, 0, ',', '.')),
            Card::make('Saldo Akhir', 'Rp. ' . number_format($balance, 0, ',', '.')),
        ];
    }
}
