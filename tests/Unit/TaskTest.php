<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Task;
use App\Project;

class TaskTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function it_has_a_path()
    {
        $task = factory(Task::class)->create();

        $this->assertEquals('/projects/' . $task->project->id . '/tasks/' . $task->id, $task->path());
    }
    
    /** @test */
    public function it_belongs_to_a_project()
    {
        $task = factory('App\Task')->create();
        $this->assertInstanceOf(Project::class, $task->project);
    }
    
    /** @test */
    public function it_can_be_completed()
    {
        $task= factory('App\Task')->create();
        $this->assertFalse($task->completed);
        $task->complete();
        $this->assertTrue($task->completed);
    }
    /** @test */
    public function it_can_be_incompleted()
    {
        $task= factory('App\Task')->create(['completed'=>true]);
        $this->assertTrue($task->completed);
        $task->incomplete();
        $this->assertFalse($task->completed);
    }
}
