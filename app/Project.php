<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Task;
use App\Activity;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\Feature\ActivityFeedTest;
Use App\RecordActivity;

class Project extends Model
{
    use RecordActivity;
    public $fillable=['title','description','user_id','notes'];
 

    public function path()
    {
        return "/projects/$this->id";
    }

    public function user()
    {
        return $this-> belongsTo(User::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
    
    public function addTask($body)
    {
        $task = $this->tasks()->create(compact('body'));

      
        return $task;
    }
    
    public function activity()
    {
       return $this->hasMany(Activity::class);
    } 
    
    public function invite(User $user)
    {
        return $this->members()->attach($user);
    }

    public function members()
    {
       return $this->belongsToMany(User::class, 'projects_members')->withTimestamps();
    }
}
