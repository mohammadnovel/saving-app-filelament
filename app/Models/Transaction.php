<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Menambahkan kolom yang bisa diisi secara massal
    protected $fillable = [
        'category_id',
        'type',
        'amount',
        'description',
        'date',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}