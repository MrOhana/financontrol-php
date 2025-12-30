<?php

namespace Tests\Unit;

use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Services\ExpenseService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExpenseServiceTest extends TestCase
{
    use RefreshDatabase;

    private $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new ExpenseService();
    }

    public function test_can_create_expense()
    {
        $category = ExpenseCategory::factory()->create();
        $data = [
            'name' => 'Lunch',
            'description' => 'Business lunch',
            'value' => 50.00,
            'date' => '2023-10-27',
            'category_id' => $category->id,
            'is_fixed' => false,
        ];

        $expense = $this->service->createExpense($data);

        $this->assertInstanceOf(Expense::class, $expense);
        $this->assertEquals(50.00, $expense->value);
        $this->assertDatabaseHas('expenses', ['name' => 'Lunch']);
    }

    public function test_can_update_expense()
    {
        $category = ExpenseCategory::factory()->create();
        $expense = Expense::create([
            'name' => 'Old Lunch',
            'value' => 40.00,
            'date' => '2023-10-26',
            'category_id' => $category->id,
            'is_fixed' => false,
        ]);

        $data = [
            'name' => 'New Lunch',
            'value' => 60.00,
            'date' => '2023-10-27',
            'category_id' => $category->id,
            'is_fixed' => true,
            'description' => 'Updated',
        ];

        $updated = $this->service->updateExpense($expense, $data);

        $this->assertEquals('New Lunch', $updated->name);
        $this->assertEquals(60.00, $updated->value);
        $this->assertTrue($updated->is_fixed);
    }

    public function test_can_delete_expense()
    {
        $category = ExpenseCategory::factory()->create();
        $expense = Expense::create([
            'name' => 'To Delete',
            'value' => 10.00,
            'date' => '2023-10-25',
            'category_id' => $category->id,
        ]);

        $result = $this->service->deleteExpense($expense);

        $this->assertTrue($result);
        $this->assertDatabaseMissing('expenses', ['id' => $expense->id]);
    }
}
