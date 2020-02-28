<?php

namespace Tests\Feature;

use App\Project;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_project_can_have_tasks()
    {
        $this-> withoutExceptionHandling();

        $this->singIn();

        $project = factory(Project::class)->create(['user_id' => auth()->id()]);

        $this->post($project->path() . '/tasks', ['body' =>'Lorem ipsum task']);
        $this->get($project->path())->assertSee('Lorem ipsum task');
    }

    /** @test */
    public function a_task_requires_a_body()
    {
        

        $this->singIn();
        
        $project = factory(Project::class)->create(['user_id' => auth()->id()]);

        
        $atributtes = factory('App\Task')->raw(['body' => '']);

        $this->post($project->path().'/tasks',$atributtes)->assertSessionHasErrors('body');
    }
    
    /** @test */
    public function only_the_owner_of_a_project_can_add_tasks()
    {
        $this->singIn();

        $project= factory('App\Project')->create();

        $this->post($project->path().'/tasks',['body' => 'Lorem ipsum'])->assertStatus(403);

    }

    /** @test */
    public function only_the_owner_of_a_project_can_update_tasks()
    {
        $this->singIn();

        $project= factory('App\Project')->create();

        $task  = $project->addTask('Tasks');

        $this->patch($task->path(),[
            'body' => 'changed',
            'completed' =>  true
        ])->assertStatus(403);
        

    }

    /** @test */
    public function guests_cannot_add_tasks()
    {
        $project = factory('App\Project')->create();
        $this->post($project->path(). "/tasks") ->assertRedirect('/login');
    }

    /** @test */
    public function a_task_can_be_updated()
    {
        $this-> withoutExceptionHandling();

        $this->singIn();
        $project= factory('App\Project')->create(['user_id' => auth()->id()]);
        $task  = $project->addTask('Tasks');

        $this->patch($task->path(),[
            'body' => 'changed',
            'completed' =>  true
        ]);
        $this->assertDatabaseHas('tasks',[
            'body' => 'changed',
            'completed' => true
        ]);
    }
    
    
    
}
