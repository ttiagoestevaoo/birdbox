<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;

class ActivityFeedTest extends TestCase
{
    use RefreshDatabase;

    
    
    /** @test */
    public function creating_a_project_generates_activity()
    {
        $this->withoutExceptionHandling();
        $project = ProjectFactory::create();

        $this->assertCount(1,$project->activity);
        $this->assertEquals('created',$project->activity->first()->description);
    }
    
    /** @test */
    public function update_a_project_generates_activity()
    {
        $this->withoutExceptionHandling();
        $project = ProjectFactory::create();
        $project->update(['title'=>'changed']);

        $this->assertCount(2,$project->activity);
        $this->assertEquals('updated',$project->activity[1]->description);
    }

    /** @test */
    public function creating_a_taks_generates_activity()
    {
        $this->withoutExceptionHandling();
        $project = ProjectFactory::create();
        $project->addTask('Some task');
        $this->assertCount(2,$project->activity);
        $this->assertEquals('created_task',$project->activity[1]->description);
    }

    
    /** @test */
    public function completing_a_taks_generates_activity()
    {
        $this->withoutExceptionHandling();
        $project = ProjectFactory::withTasks(1)->create();
        $this->actingAs($this->singIn($project->user))
        ->patch($project->tasks[0]->path(), [
            'body' => 'Teste',
            'completed' => True
        ]);
        $this->assertCount(3,$project->activity);
    }
}