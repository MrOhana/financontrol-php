<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="text-gray-500 font-bold text-sm uppercase mb-1">Total Incomes</div>
                <div class="text-2xl font-bold text-green-600">R$ {{ number_format($totalIncomes, 2, ',', '.') }}</div>
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="text-gray-500 font-bold text-sm uppercase mb-1">Total Expenses</div>
                <div class="text-2xl font-bold text-red-600">R$ {{ number_format($totalExpenses, 2, ',', '.') }}</div>
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="text-gray-500 font-bold text-sm uppercase mb-1">Balance</div>
                <div class="text-2xl font-bold {{ $balance >= 0 ? 'text-blue-600' : 'text-red-600' }}">R$
                    {{ number_format($balance, 2, ',', '.') }}</div>
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="text-gray-500 font-bold text-sm uppercase mb-1">Active Goals</div>
                <div class="text-2xl font-bold text-indigo-600">{{ $activeGoals }}</div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Recent Expenses -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Recent Expenses</h3>
                <ul class="divide-y divide-gray-200">
                    @foreach($recentExpenses as $expense)
                        <li class="py-3 flex justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $expense->name }}</p>
                                <p class="text-xs text-gray-500">{{ $expense->date->format('d/m/Y') }} -
                                    {{ $expense->category->name }}</p>
                            </div>
                            <span class="text-sm font-bold text-red-600">-R$
                                {{ number_format($expense->value, 2, ',', '.') }}</span>
                        </li>
                    @endforeach
                </ul>
                <div class="mt-4 text-right">
                    <a href="{{ route('expenses') }}" class="text-sm text-indigo-600 hover:text-indigo-900">View all</a>
                </div>
            </div>

            <!-- Recent Incomes -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Recent Incomes</h3>
                <ul class="divide-y divide-gray-200">
                    @foreach($recentIncomes as $income)
                        <li class="py-3 flex justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $income->name }}</p>
                                <p class="text-xs text-gray-500">{{ $income->date->format('d/m/Y') }} -
                                    {{ $income->category->name }}</p>
                            </div>
                            <span class="text-sm font-bold text-green-600">+R$
                                {{ number_format($income->value, 2, ',', '.') }}</span>
                        </li>
                    @endforeach
                </ul>
                <div class="mt-4 text-right">
                    <a href="{{ route('incomes') }}" class="text-sm text-indigo-600 hover:text-indigo-900">View all</a>
                </div>
            </div>
        </div>
    </div>
</div>