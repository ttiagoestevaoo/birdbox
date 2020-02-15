<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;
    
    /** @test*/
    public function a_user_can_create_a_project()
    {
        $this-> withoutExceptionHandling();
        $this->actingAs(factory('App\User')->create());

        
        $atributtes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            
        ];

        $this->post('/projects',$atributtes);

        $this->assertDatabaseHas('projects',$atributtes);

        $this -> get('/projects')->assertSee($atributtes['title']);
    }

     /** @test*/
    public function a_project_requires_a_title()
    {
        $this->actingAs(factory('App\User')->create());

        $atributtes = factory('App\Project')->raw(['title'=>'']);
        $this->post('/projects',$atributtes)->assertSessionHasErrors('title');
    }

    /** @test*/
    public function a_project_requires_a_description()
    {
        $this->actingAs(factory('App\User')->create());
        $atributtes = factory('App\Project')->raw(['description'=>'']);
        $this->post('/projects',$atributtes)->assertSessionHasErrors('description');
    }

    /** @test*/
     public function only_authenticated_users_can_create_projects()
    {
        
        
        $atributtes = factory('App\Project')->raw();
        $this->post('/projects',$atributtes)->assertRedirect('login');
    }

    /** @test*/
    public function a_project_requires_validation()
    {
  
        $this-> withoutExceptionHandling();
        $this->actingAs(factory('App\User')->create());

        $project = factory('App\Project')-> create();
        $this->get('/projects/' . $project->id)->assertSee($project->title)->assertSee($project->description);
  
    }
} 
