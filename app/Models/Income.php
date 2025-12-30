<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Income extends Model
{
    use HasFactory;

    // Assuming we want to use ExpenseCategory for Incomes too, or just store the ID for now.
    // Based on migration, we have category_id. 
    // If we want a relationship, I'll add it, possibly pointing to ExpenseCategory or a future IncomeCategory.
    // For now, I will relate it to ExpenseCategory as that's the only Category entity we have.

    protected $fillable = [
        'name',
        'description',
        'value',
        'date',
        'is_fixed',
        'category_id',
    ];

    protected $casts = [
        'date' => 'date',
        'is_fixed' => 'boolean',
        'value' => 'decimal:2',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ExpenseCategory::class, 'category_id');
    }
}
