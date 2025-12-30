<?php

namespace App\Services;

use App\Models\Income;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class IncomeService
{
    /**
     * Create a new income.
     *
     * @param array $data
     * @return Income
     */
    public function createIncome(array $data): Income
    {
        return DB::transaction(function () use ($data) {
            return Income::create($data);
        });
    }

    /**
     * Update an existing income.
     *
     * @param Income $income
     * @param array $data
     * @return Income
     */
    public function updateIncome(Income $income, array $data): Income
    {
        return DB::transaction(function () use ($income, $data) {
            $income->update($data);
            return $income->refresh();
        });
    }

    /**
     * Delete an income.
     *
     * @param Income $income
     * @return bool
     */
    public function deleteIncome(Income $income): bool
    {
        return $income->delete();
    }

    /**
     * Get all incomes.
     *
     * @return Collection
     */
    public function getAllIncomes(): Collection
    {
        return Income::with('category')->latest('date')->get();
    }
}
