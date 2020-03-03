<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;

class ManageTasksTest extends TestCase
{
   use RefreshDatabase;
   /** @test */
   public function a_user_can_view_theirs_tasks()
   {
       $this->withoutExceptionHandling();
       $project = ProjectFactory::withTasks(1)->ownedBy($this->singIn())->create();
       $this->get('/tasks')->assertSee($project->tasks[0]->body);
   }
   
}
