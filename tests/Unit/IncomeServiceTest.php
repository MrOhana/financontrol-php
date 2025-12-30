<?php

namespace Tests\Unit;

use App\Models\Income;
use App\Models\ExpenseCategory;
use App\Services\IncomeService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IncomeServiceTest extends TestCase
{
    use RefreshDatabase;

    private $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new IncomeService();
    }

    public function test_can_create_income()
    {
        $category = ExpenseCategory::factory()->create();
        $data = [
            'name' => 'Salary',
            'description' => 'Monthly Salary',
            'value' => 5000.00,
            'date' => '2023-10-01',
            'category_id' => $category->id,
            'is_fixed' => true,
        ];

        $income = $this->service->createIncome($data);

        $this->assertInstanceOf(Income::class, $income);
        $this->assertEquals(5000.00, $income->value);
        $this->assertDatabaseHas('incomes', ['name' => 'Salary']);
    }

    public function test_can_update_income()
    {
        $category = ExpenseCategory::factory()->create();
        $income = Income::create([
            'name' => 'Old Salary',
            'value' => 4000.00,
            'date' => '2023-09-01',
            'category_id' => $category->id,
            'is_fixed' => true,
        ]);

        $data = [
            'name' => 'New Salary',
            'value' => 5500.00,
            'date' => '2023-10-01',
            'category_id' => $category->id,
            'is_fixed' => true,
        ];

        $updated = $this->service->updateIncome($income, $data);

        $this->assertEquals('New Salary', $updated->name);
        $this->assertEquals(5500.00, $updated->value);
    }

    public function test_can_delete_income()
    {
        $category = ExpenseCategory::factory()->create();
        $income = Income::create([
            'name' => 'Bonus',
            'value' => 1000.00,
            'date' => '2023-12-25',
            'category_id' => $category->id,
        ]);

        $result = $this->service->deleteIncome($income);

        $this->assertTrue($result);
        $this->assertDatabaseMissing('incomes', ['id' => $income->id]);
    }
}
