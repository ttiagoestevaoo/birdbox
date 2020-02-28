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
    
}
