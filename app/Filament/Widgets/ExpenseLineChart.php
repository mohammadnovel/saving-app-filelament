<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Filament\Widgets\ChartWidget;

class ExpenseLineChart extends ChartWidget
{
    protected static ?string $heading = 'Pengeluaran per Kategori';

    protected static ?string $maxHeight = '350px'; // Atur tinggi chart agar tidak terlalu besar

    public static function getSort(): int
    {
        return 2; // Tampil paling atas
    }

    protected function getData(): array
    {
        $data = Transaction::with('category')
            ->where('type', 'expense')
            ->selectRaw('category_id, SUM(amount) as total')
            ->groupBy('category_id')
            ->get();

        return [
            'labels' => $data->map(fn($item) => optional($item->category)->name ?? 'Tanpa Kategori')->toArray(),
            'datasets' => [
                [
                    'label' => 'Total Pengeluaran',
                    'data' => $data->pluck('total')->toArray(),
                    'borderColor' => 'rgba(255, 99, 132, 1)',
                    'backgroundColor' => 'rgba(255, 99, 132, 0.2)',
                    'fill' => true,
                ]
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
