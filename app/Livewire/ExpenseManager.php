<?php

namespace App\Livewire;

use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\Goal;
use App\Services\ExpenseService;
use Livewire\Component;
use Livewire\WithPagination;

class ExpenseManager extends Component
{
    use WithPagination;

    public $confirmingExpenseDeletion = false;
    public $confirmingExpenseAdd = false;
    public $confirmingExpenseEdit = false;

    public $expenseIdBeingDeleted;
    public $expenseIdBeingEdited;

    public $name;
    public $description;
    public $value;
    public $date;
    public $is_fixed = false;
    public $category_id;
    public $goal_id;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'value' => 'required|numeric|min:0.01',
        'date' => 'required|date',
        'is_fixed' => 'boolean',
        'category_id' => 'required|exists:expense_categories,id',
        'goal_id' => 'nullable|exists:goals,id',
    ];

    public function render()
    {
        $expenses = app(ExpenseService::class)->getAllExpenses();
        // Pagination logic could be added to service or here. For now simpler service returning collection. 
        // If collection is large, service should return builder or paginator.
        // Given service returns collection, I'll allow it for now but in real app I'd change service signature.

        return view('livewire.expense-manager', [
            'expenses' => $expenses,
            'categories' => ExpenseCategory::all(),
            'goals' => Goal::all(),
        ]);
    }

    public function confirmExpenseAdd()
    {
        $this->reset(['name', 'description', 'value', 'date', 'is_fixed', 'category_id', 'goal_id', 'expenseIdBeingEdited']);
        $this->confirmingExpenseAdd = true;
    }

    public function saveExpense(ExpenseService $service)
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'value' => $this->value,
            'date' => $this->date,
            'is_fixed' => $this->is_fixed,
            'category_id' => $this->category_id,
            'goal_id' => $this->goal_id ?: null,
        ];

        if ($this->expenseIdBeingEdited) {
            $expense = Expense::find($this->expenseIdBeingEdited);
            $service->updateExpense($expense, $data);
        } else {
            $service->createExpense($data);
        }

        $this->confirmingExpenseAdd = false;
        $this->confirmingExpenseEdit = false;
        $this->reset(['name', 'description', 'value', 'date', 'is_fixed', 'category_id', 'goal_id', 'expenseIdBeingEdited']);
    }

    public function confirmExpenseEdit($id)
    {
        $this->resetErrorBag();
        $expense = Expense::find($id);
        $this->expenseIdBeingEdited = $id;
        $this->name = $expense->name;
        $this->description = $expense->description;
        $this->value = $expense->value;
        $this->date = $expense->date->format('Y-m-d');
        $this->is_fixed = $expense->is_fixed;
        $this->category_id = $expense->category_id;
        $this->goal_id = $expense->goal_id;

        $this->confirmingExpenseEdit = true;
    }

    public function confirmExpenseDeletion($id)
    {
        $this->confirmingExpenseDeletion = true;
        $this->expenseIdBeingDeleted = $id;
    }

    public function deleteExpense(ExpenseService $service)
    {
        $expense = Expense::find($this->expenseIdBeingDeleted);
        $service->deleteExpense($expense);
        $this->confirmingExpenseDeletion = false;
        $this->expenseIdBeingDeleted = null;
    }
}
