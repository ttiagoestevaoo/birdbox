<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public $fillable=['title','description','user_id'];

    

    public function path()
    {
        return "/projects/$this->id";
    }
    
}
