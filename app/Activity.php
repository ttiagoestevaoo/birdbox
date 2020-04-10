<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Activity extends Model
{
    protected $fillable=['project_id','description','changes','user_id'];

    protected $casts = ['changes'=> 'array'];
    public function subject()
    {
      return $this->morphTo();
    }

    public function changes()
    {
      
    }

    public function user()
    {
      return $this->belongsTo(User::class);
    }
}
