<?php

namespace App\Livewire;

use App\Models\Income;
use App\Models\ExpenseCategory;
use App\Services\IncomeService;
use Livewire\Component;
use Livewire\WithPagination;

class IncomeManager extends Component
{
    use WithPagination;

    public $confirmingIncomeDeletion = false;
    public $confirmingIncomeAdd = false;
    public $confirmingIncomeEdit = false;

    public $incomeIdBeingDeleted;
    public $incomeIdBeingEdited;

    public $name;
    public $description;
    public $value;
    public $date;
    public $is_fixed = false;
    public $category_id;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'value' => 'required|numeric|min:0.01',
        'date' => 'required|date',
        'is_fixed' => 'boolean',
        'category_id' => 'required|exists:expense_categories,id',
    ];

    public function render()
    {
        $incomes = app(IncomeService::class)->getAllIncomes();

        return view('livewire.income-manager', [
            'incomes' => $incomes,
            'categories' => ExpenseCategory::all(),
        ]);
    }

    public function confirmIncomeAdd()
    {
        $this->reset(['name', 'description', 'value', 'date', 'is_fixed', 'category_id', 'incomeIdBeingEdited']);
        $this->confirmingIncomeAdd = true;
    }

    public function saveIncome(IncomeService $service)
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'value' => $this->value,
            'date' => $this->date,
            'is_fixed' => $this->is_fixed,
            'category_id' => $this->category_id,
        ];

        if ($this->incomeIdBeingEdited) {
            $income = Income::find($this->incomeIdBeingEdited);
            $service->updateIncome($income, $data);
        } else {
            $service->createIncome($data);
        }

        $this->confirmingIncomeAdd = false;
        $this->confirmingIncomeEdit = false;
        $this->reset(['name', 'description', 'value', 'date', 'is_fixed', 'category_id', 'incomeIdBeingEdited']);
    }

    public function confirmIncomeEdit($id)
    {
        $this->resetErrorBag();
        $income = Income::find($id);
        $this->incomeIdBeingEdited = $id;
        $this->name = $income->name;
        $this->description = $income->description;
        $this->value = $income->value;
        $this->date = $income->date->format('Y-m-d');
        $this->is_fixed = $income->is_fixed;
        $this->category_id = $income->category_id;

        $this->confirmingIncomeEdit = true;
    }

    public function confirmIncomeDeletion($id)
    {
        $this->confirmingIncomeDeletion = true;
        $this->incomeIdBeingDeleted = $id;
    }

    public function deleteIncome(IncomeService $service)
    {
        $income = Income::find($this->incomeIdBeingDeleted);
        $service->deleteIncome($income);
        $this->confirmingIncomeDeletion = false;
        $this->incomeIdBeingDeleted = null;
    }
}
