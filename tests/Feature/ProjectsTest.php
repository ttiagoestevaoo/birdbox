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
    /** @test */
    public function an_authenticated_user_can_not_view_other_projects()
    {
        $this->be(factory('App\User')->create());

        
        $project = factory('App\Project')->create();

        
        $this->get($project->path())->assertStatus(403);
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
     public function guest_can_not_view_projects()
    {               
       
        $this->get('/projects')->assertRedirect('login');
    }

    /** @test*/
    public function guest_can_not_view_a_project()
    {               
        $project = factory('App\Project')->create();
        $this->get($project->path())->assertRedirect('login');
    }

    public function guest_can_not_create_projects()
    {
        
        
        $atributtes = factory('App\Project')->raw();
        $this->post('/projects',$atributtes)->assertRedirect('login');
    }

    
} 
