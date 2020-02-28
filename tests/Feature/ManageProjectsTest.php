<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Project;

class ManageProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;
    
    /** @test*/
    public function a_user_can_manage_a_project()
    {
        $this-> withoutExceptionHandling();
        $this->singIn();

        $this->get('/projects/create')->assertStatus(200);
        
        $atributtes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'notes' => $this->faker->paragraph
            
        ];

        $response = $this->post('/projects',$atributtes);
        $project = Project::where($atributtes)->first();
        $response->assertRedirect($project->path());        
        $this->assertDatabaseHas('projects',$atributtes);
        
        $this -> get($project->path())
        ->assertSee($atributtes['title'])
        ->assertSee($atributtes['notes'])
        ->assertSee($atributtes['description']);
        
        $this->patch($project->path(),[            
            'notes' =>  'changed'
        ]);
        $this->assertDatabaseHas('projects',[
            'notes' =>  'changed'
        ]);
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
    }


    
} 
