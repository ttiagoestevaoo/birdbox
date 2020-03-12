<?php

namespace Tests\Feature\Web;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;
Use App\Task;

class RecordActivityFeedTest extends TestCase
{
    use RefreshDatabase;

    
    
    /** @test */
    public function creating_a_project()
    {
        $this->withoutExceptionHandling();
        $project = ProjectFactory::create();

        $this->assertCount(1,$project->activity);
        tap($project->activity->last(), function($activity){
            $this->assertEquals('created_project',$activity->description);
            
            $this->assertNull($activity->changes);
        });
    }
    
    /** @test */
    public function update_a_project()
    {
        $this->withoutExceptionHandling();
        $project = ProjectFactory::create();
        $originalTitle = $project->title;
        $project->update(['title'=>'changed']);
        $this->assertCount(2,$project->activity);
        tap($project->activity->last(), function($activity) use ($originalTitle){
            $this->assertEquals('updated_project',$activity->description);
            $expected= [
                'before' => ['title' => $originalTitle],
                'after' => ['title' => 'changed']
            ];
            $this->assertEquals($expected, $activity->changes);
        });
    }

    /** @test */
    public function creating_a_taks()
    {
        $this->withoutExceptionHandling();
        $project = ProjectFactory::withTasks(1)->create();
    ;
        $this->assertCount(2,$project->activity);

        tap($project->activity->last(),function ($activity){
            $this->assertEquals('created_task',$activity->description);
            $this->assertInstanceOf(Task::class, $activity->subject);
        });
    }

    
    /** @test */
    public function completing_a_taks()
    {
        $this->withoutExceptionHandling();
        $project = ProjectFactory::withTasks(1)->create();
        $this->actingAs($this->singIn($project->user))
        ->patch($project->tasks[0]->path(), [
            'body' => 'Teste',
            'completed' => True
        ]);
        $this->assertCount(3,$project->activity);
        $this->assertEquals($project->activity[2]->description, 'completed_task');
    } 
    /** @test */
    public function incompleting_a_taks()
    {
        $this->withoutExceptionHandling();
        $project = ProjectFactory::withTasks(1)->create();
        $this->actingAs($this->singIn($project->user))
        ->patch($project->tasks[0]->path(), [
            'body' => 'Teste',
            'completed' => True
        ]);
        $this->assertCount(3,$project->activity);
        
        

        $this->actingAs($this->singIn($project->user))
        ->patch($project->tasks[0]->path(), [
            'body' => 'Teste',
            'completed' => false
        ]);

        $project->refresh();

        $this->assertCount(4,$project->activity);
        $this->assertEquals($project->activity[3]->description, 'uncompleted_task');

    }
    /** @test */
    public function deleting_a_taks()
    {
        $this->withoutExceptionHandling();
        $project = ProjectFactory::withTasks(1)->create();
        $project->tasks[0]->delete();

        $this->assertCount(3,$project->activity);
        
    } 
}