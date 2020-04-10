<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectsTest extends TestCase
{
use RefreshDatabase;
 /** @test */
 public  function it_has_a_path()
 {
    
    $project = factory('App\Project')->create();
     $this->assertEquals('/projects/' . $project->id,$project->path());
 }

 /** @test */
 public function it_belongs_to()
 {

    $project = factory('App\Project')->create();

    $this->assertInstanceOf('App\User',$project->user);
 }

/** @test */
 public function it_can_add_a_task()
 {
   $project = factory('App\Project')->create();

   $task = $project-> addTask('Lorem ipsum');

   
   $this-> assertTrue($project->tasks->contains($task));
 }

 /** @test */
 public function it_can_invite_a_user()
 {
   $project= factory('App\Project')->create();
   $project->invite($user = factory('App\User')->create());
   $this->assertTrue($project->members->contains($user));
 }
 

}
