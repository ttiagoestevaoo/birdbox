<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Project extends Model
{
    public $fillable=['title','description','user_id'];

    

    public function path()
    {
        return "/projects/$this->id";
    }

    public function user()
    {
        return $this-> belongsTo(User::class);
    }
    
}
