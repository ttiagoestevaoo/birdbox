<?php

namespace Tests\Unit;

use App\Project;
use App\User;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ActivityTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function a_activity_has_user()
    {        

        $project = factory(Project::class)->create();
        
        $this->assertInstanceOf(User::class,$project->activity->first()->user);
    }
    
}
