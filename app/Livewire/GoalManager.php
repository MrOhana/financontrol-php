<?php

namespace App\Livewire;

use App\Models\Goal;
use App\Services\GoalService;
use Livewire\Component;
use Livewire\WithPagination;

class GoalManager extends Component
{
    use WithPagination;

    public $confirmingGoalDeletion = false;
    public $confirmingGoalAdd = false;
    public $confirmingGoalEdit = false;

    public $goalIdBeingDeleted;
    public $goalIdBeingEdited;

    public $name;
    public $description;
    public $start_date;
    public $end_date;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'start_date' => 'required|date',
        'end_date' => 'nullable|date|after_or_equal:start_date',
    ];

    public function render()
    {
        $goals = app(GoalService::class)->getAllGoals();

        return view('livewire.goal-manager', [
            'goals' => $goals,
        ]);
    }

    public function confirmGoalAdd()
    {
        $this->reset(['name', 'description', 'start_date', 'end_date', 'goalIdBeingEdited']);
        $this->confirmingGoalAdd = true;
    }

    public function saveGoal(GoalService $service)
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date ?: null,
        ];

        if ($this->goalIdBeingEdited) {
            $goal = Goal::find($this->goalIdBeingEdited);
            $service->updateGoal($goal, $data);
        } else {
            $service->createGoal($data);
        }

        $this->confirmingGoalAdd = false;
        $this->confirmingGoalEdit = false;
        $this->reset(['name', 'description', 'start_date', 'end_date', 'goalIdBeingEdited']);
    }

    public function confirmGoalEdit($id)
    {
        $this->resetErrorBag();
        $goal = Goal::find($id);
        $this->goalIdBeingEdited = $id;
        $this->name = $goal->name;
        $this->description = $goal->description;
        $this->start_date = $goal->start_date->format('Y-m-d');
        $this->end_date = $goal->end_date ? $goal->end_date->format('Y-m-d') : null;

        $this->confirmingGoalEdit = true;
    }

    public function confirmGoalDeletion($id)
    {
        $this->confirmingGoalDeletion = true;
        $this->goalIdBeingDeleted = $id;
    }

    public function deleteGoal(GoalService $service)
    {
        $goal = Goal::find($this->goalIdBeingDeleted);
        $service->deleteGoal($goal);
        $this->confirmingGoalDeletion = false;
        $this->goalIdBeingDeleted = null;
    }
}
