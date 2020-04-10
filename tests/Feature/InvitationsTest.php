<?php

namespace Tests\Feature;

use App\Project;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;

class InvitationsTest extends TestCase
{
   use RefreshDatabase;

    /** @test */
    public function invited_user_may_update_project_details()
    {
        $project = ProjectFactory::create();
        $project->invite($newUser = factory(\App\User::class)->create());

        $this->singIn($newUser);

        $this->post(action('ProjectsTasksController@store',$project),$task = ['body' => 'Foo task']);

        $this->assertDatabaseHas('tasks', $task);
    }

    /** @test */
    public function non_owners_may_not_invite_users()
    {
        $user =factory(User::class)->create();
        $project = ProjectFactory::create();
        
        $assertInvitationsForbidden = function () use ($user, $project){
            $this->actingAs($user)
            ->post($project->path().'/invitations')
            ->assertStatus(403);
        };

        $assertInvitationsForbidden();
        $project->invite($user);

        $assertInvitationsForbidden();
        
        
    }
    
    

    /** @test */
    public function the_invited_email_must_be_associtead_with_birdbord_account()
    {
        $project = ProjectFactory::create();

        $this->actingAs($project->user)->post($project->path()."/invitations",[
            'email' => 'example@example.com'
        ])->assertSessionHasErrors(['email' => 'The user you are invitating must have a Soogest account'], null,$errorBag = 'invitations');
    }
    

    /** @test */
    public function a_project_can_invite_a_user()
    {
        $this->withoutExceptionHandling();
        $project = ProjectFactory::create();
         
        $userToInvite = factory(User::class)->create();

        $this->actingAs($project->user)->post($project->path(). '/invitations',[
            'email' => $userToInvite->email
        ]);

        $this->assertTrue($project->members->contains($userToInvite));
    }
    
}
