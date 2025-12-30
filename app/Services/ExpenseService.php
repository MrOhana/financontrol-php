<?php

namespace App\Services;

use App\Models\Expense;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class ExpenseService
{
    /**
     * Create a new expense.
     *
     * @param array $data
     * @return Expense
     */
    public function createExpense(array $data): Expense
    {
        return DB::transaction(function () use ($data) {
            return Expense::create($data);
        });
    }

    /**
     * Update an existing expense.
     *
     * @param Expense $expense
     * @param array $data
     * @return Expense
     */
    public function updateExpense(Expense $expense, array $data): Expense
    {
        return DB::transaction(function () use ($expense, $data) {
            $expense->update($data);
            return $expense->refresh();
        });
    }

    /**
     * Delete an expense.
     *
     * @param Expense $expense
     * @return bool
     */
    public function deleteExpense(Expense $expense): bool
    {
        return $expense->delete();
    }

    /**
     * Get expenses by user (assuming expenses might be scoped by user later, or global for now).
     * Since the specs didn't explicitly link Expense to User, I'll assume single user or add relationship later.
     * For now, just listing.
     * 
     * @return Collection
     */
    public function getAllExpenses(): Collection
    {
        return Expense::with(['category', 'goal'])->latest('date')->get();
    }
}
