<?php

namespace App\Services;

use App\Models\Goal;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class GoalService
{
    /**
     * Create a new goal.
     *
     * @param array $data
     * @return Goal
     */
    public function createGoal(array $data): Goal
    {
        return DB::transaction(function () use ($data) {
            return Goal::create($data);
        });
    }

    /**
     * Update an existing goal.
     *
     * @param Goal $goal
     * @param array $data
     * @return Goal
     */
    public function updateGoal(Goal $goal, array $data): Goal
    {
        return DB::transaction(function () use ($goal, $data) {
            $goal->update($data);
            return $goal->refresh();
        });
    }

    /**
     * Delete a goal.
     *
     * @param Goal $goal
     * @return bool
     */
    public function deleteGoal(Goal $goal): bool
    {
        return $goal->delete();
    }

    /**
     * Get all goals.
     *
     * @return Collection
     */
    public function getAllGoals(): Collection
    {
        return Goal::latest('start_date')->get();
    }
}
