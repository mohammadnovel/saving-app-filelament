<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Filament\Widgets\ChartWidget;

class IncomeBarChart extends ChartWidget
{
    protected static ?string $heading = 'Pemasukan per Kategori';
    protected static ?string $maxHeight = '350px'; // Atur tinggi chart agar tidak terlalu besar

    public static function getSort(): int
    {
        return 3; // Tampil paling atas
    }
    protected function getData(): array
    {
        $data = Transaction::with('category')
            ->where('type', 'income')
            ->selectRaw('category_id, SUM(amount) as total')
            ->groupBy('category_id')
            ->get();

        return [
            'labels' => $data->map(fn($item) => optional($item->category)->name ?? 'Tanpa Kategori')->toArray(),
            'datasets' => [
                [
                    'label' => 'Total Pemasukan',
                    'data' => $data->pluck('total')->toArray(),
                    'backgroundColor' => 'rgba(75, 192, 192, 0.5)',
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

}
