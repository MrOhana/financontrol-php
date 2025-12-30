<?php

namespace App\Livewire;

use App\Models\Expense;
use App\Models\Income;
use App\Models\Goal;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $totalExpenses = Expense::sum('value');
        $totalIncomes = Income::sum('value');
        $activeGoals = Goal::whereNull('end_date')->orWhere('end_date', '>=', now())->count();
        $balance = $totalIncomes - $totalExpenses;

        // Fetch recent activities
        $recentExpenses = Expense::with('category')->latest('date')->take(5)->get();
        $recentIncomes = Income::with('category')->latest('date')->take(5)->get();

        return view('livewire.dashboard', [
            'totalExpenses' => $totalExpenses,
            'totalIncomes' => $totalIncomes,
            'activeGoals' => $activeGoals,
            'balance' => $balance,
            'recentExpenses' => $recentExpenses,
            'recentIncomes' => $recentIncomes,
        ]);
    }
}
