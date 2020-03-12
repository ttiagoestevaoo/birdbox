<?php

namespace Tests\Feature\Web;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Project;
use Facades\Tests\Setup\ProjectFactory;

class ManageProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;
    
    /** @test*/
    public function a_user_can_create_a_project()
    {
        $this-> withoutExceptionHandling();
        $this->singIn();

        $this->get('/projects/create')->assertStatus(200);
        
        $atributtes = [
            'title' => $this->faker->sentence,
            'notes' => $this->faker->paragraph,           
            'description' => $this->faker->sentence

        ];

        $response = $this->post('/projects',$atributtes);
        $project = Project::where($atributtes)->first();
        $response->assertRedirect($project->path());        
        $this->assertDatabaseHas('projects',$atributtes);
        
        $this -> get($project->path())
        ->assertSee($atributtes['title'])
        ->assertSee($atributtes['notes'])
        ->assertSee($atributtes['description']);
        
    }

    /** @test */
    public function a_user_can_update_general_notes()
    {
        $project = ProjectFactory::create();

        $this->actingAs($project->user)
        ->patch($project->path(),$atributtes = [
            "notes" =>  'changed'
        ]);
        $this->assertDatabaseHas('projects',$atributtes);
    }
    /** @test */
    public function a_user_can_update_a_project()
    {
        $project = ProjectFactory::create();

        $this->actingAs($project->user)
        ->patch($project->path(),$atributtes = [
            "notes" =>  'changed',
            "description" =>  'changed',
            "title" =>  'changed'
        ]);
        $this->assertDatabaseHas('projects',$atributtes);
        $this->get($project->path()."/edit")->assertOK();
    }
    
    /** @test */
    public function a_user_can_delete_their_projects()
    {
        $this->withoutExceptionHandling();
        $project = ProjectFactory::ownedBy($this->singIn())->create();
        $this->delete($project->path())->assertRedirect('/projects');

        $atributtes = [
            'notes' => $project->notes,
            'description' => $project->description,
            'title' => $project->title
        ];

        $this->assertDatabaseMissing('projects',$atributtes);
    }
    /** @test */
    public function a_user_can_view_their_projects()
    {
        
        $project = ProjectFactory::create();
        
        $this->actingAs($project->user)
        ->get($project->path())
        ->assertSee($project->title)
        ->assertSee($project->description)
        ->assertSee($project->notes);
    }
    

     /** @test*/
    public function a_project_requires_a_title()
    {
        $this->singIn();
        $atributtes = factory('App\Project')->raw(['title'=>'']);
        
        $this->post('/projects',$atributtes)->assertSessionHasErrors('title');
    }

    /** @test*/
    public function a_project_requires_a_description()
    {
        $this->singIn();

        $atributtes = factory('App\Project')->raw(['description'=>'']);
        $this->post('/projects',$atributtes)->assertSessionHasErrors('description');
    }

    /** @test*/
     public function guests_cannot_control_projects()
    {               
        $project = factory('App\Project')->create();
        $this->get('/projects')->assertRedirect('/login');
        $this->get('/projects/create')->assertRedirect('/login');
        $this->get($project->path())->assertRedirect('/login');
        $this->post('/projects',$project->toArray())->assertRedirect('login');
        $this->delete($project->path(),$project->toArray())->assertRedirect('login');
        
    }

    /** @test */
    public function an_authenticated_can_not_update_others_projects()
    {
        $this->singIn();

        $project = factory('App\Project')->create();

        
        $this->patch($project->path())-> assertStatus(403);

    }

    /** @test */
    public function an_authenticated_can_not_delete_others_projects()
    {
        $this->singIn();

        $project = factory('App\Project')->create();

        
        $this->delete($project->path())-> assertStatus(403);

    }
    
    /** @test */
    public function an_authenticated_can_not_view_others_projects()
    {
        $this->singIn();

        $project = factory('App\Project')->create();

        $this->get($project->path()) ->assertStatus(403);
        

    }
    
} 
