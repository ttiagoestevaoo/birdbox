<?php

namespace Tests\Feature\Web;

use App\Project;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Facades\Tests\Setup\ProjectFactory;

use Tests\TestCase;

class ProjectTaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_project_can_have_tasks()
    {
        $this-> withoutExceptionHandling();

        $project = ProjectFactory::ownedBy($this->singIn())->create();



        $this->post($project->path() . '/tasks', ['body' =>'Lorem ipsum task']);
        $this->get($project->path())->assertSee('Lorem ipsum task');
    }

    /** @test */
    public function a_task_requires_a_body()
    {
        $project= ProjectFactory::ownedBY($this->singIn()) ->create();

        $atributtes = factory('App\Task')->raw(['body' => '']);

        $this->post($project->path().'/tasks',$atributtes)->assertSessionHasErrors('body');
    }
    
    /** @test */
    public function only_the_owner_of_a_project_can_add_tasks()
    {
        $this->singIn();

        $project= ProjectFactory::create();
        $this->post($project->path().'/tasks',['body' => 'Lorem ipsum'])->assertStatus(403);

    }

    /** @test */
    public function only_the_owner_of_a_project_can_update_tasks()
    {
        $this->singIn();

        $project= ProjectFactory::withTasks(1) ->create();

        $this->patch($project->tasks->first()->path(),[
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

        $project = ProjectFactory::withTasks(1)->create();        

        $this->actingAs($project->user)
        ->patch($project->tasks->first()->path(),[
            'body' => 'changed'
        ]);
        $this->assertDatabaseHas('tasks',[
            'body' => 'changed'
        ]);
    }
    
    /** @test */
    public function a_task_can_be_completed()
    {
        $this-> withoutExceptionHandling();

        $project = ProjectFactory::withTasks(1)->create();        

        $this->actingAs($project->user)
        ->patch($project->tasks->first()->path(),[
            'body' => 'changed',            
            'completed' =>  true
        ]);
        $this->assertDatabaseHas('tasks',[            
            'body' => 'changed',
            'completed' => true
        ]);
    }
    
    /** @test */
    public function a_task_can_be_incompleted()
    {
        $this-> withoutExceptionHandling();

        $project = ProjectFactory::withTasks(1)->create();        

        $this->actingAs($project->user)
        ->patch($project->tasks->first()->path(),[
            'body' => 'changed',            
            'completed' =>  false
        ]);
        $this->assertDatabaseHas('tasks',[            
            'body' => 'changed',
            'completed' => false
        ]);
    }
    
}
