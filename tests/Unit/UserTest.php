<?php

namespace Tests\Unit;

use App\Project;
use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Collection;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_has_projects()
    {
        $user = factory('App\User')->create();

        $this->assertInstanceOf(Collection::class, $user->projects);

    }

   
    public function a_user_has_tasks()
    {
        $user = factory('App\User')->create();

        $this->assertInstanceOf(Collection::class, $user->tasks);


    }
    
    /** @test */
    public function a_user_has_accessible_projects()
    {
        $john = $this->singIn();

        $project = ProjectFactory::ownedBy($john)->create();

        $this->assertCount(1, $john->accessibleProjects());

        $sally = factory('App\User')->create();        
        $nick = factory('App\User')->create();

        $sallyProject =  ProjectFactory::ownedBy($sally)->create();
        $sallyProject->invite($nick);

        $this->assertCount(1, $john->accessibleProjects());

        $sallyProject->invite($john);

        $this->assertCount(2, $john->accessibleProjects());

    }
    
}