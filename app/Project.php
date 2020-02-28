<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Task;

class Project extends Model
{
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
        return $this->tasks()->create(compact('body'));
    }
    
}
