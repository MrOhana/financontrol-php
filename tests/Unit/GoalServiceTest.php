<?php

namespace Tests\Unit;

use App\Models\Goal;
use App\Services\GoalService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GoalServiceTest extends TestCase
{
    use RefreshDatabase;

    private $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new GoalService();
    }

    public function test_can_create_goal()
    {
        $data = [
            'name' => 'Buy Car',
            'description' => 'Save for a new Tesla',
            'start_date' => '2023-01-01',
            'end_date' => '2025-01-01',
        ];

        $goal = $this->service->createGoal($data);

        $this->assertInstanceOf(Goal::class, $goal);
        $this->assertEquals('Buy Car', $goal->name);
        $this->assertDatabaseHas('goals', ['name' => 'Buy Car']);
    }

    public function test_can_create_long_term_goal_without_end_date()
    {
        $data = [
            'name' => 'Retirement',
            'start_date' => '2023-01-01',
            'end_date' => null,
        ];

        $goal = $this->service->createGoal($data);

        $this->assertNull($goal->end_date);
    }

    public function test_can_update_goal()
    {
        $goal = Goal::create([
            'name' => 'Old Goal',
            'start_date' => '2023-01-01',
        ]);

        $data = [
            'name' => 'New Goal',
            'start_date' => '2023-01-01',
            'description' => 'Updated',
        ];

        $updated = $this->service->updateGoal($goal, $data);

        $this->assertEquals('New Goal', $updated->name);
    }

    public function test_can_delete_goal()
    {
        $goal = Goal::create([
            'name' => 'To Delete',
            'start_date' => '2023-01-01',
        ]);

        $result = $this->service->deleteGoal($goal);

        $this->assertTrue($result);
        $this->assertDatabaseMissing('goals', ['id' => $goal->id]);
    }
}
