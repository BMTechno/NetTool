<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Command extends Model
{
    
    protected $table = 'commands';

    protected $fillable = [
    	'command', 
    ];

  	public function modelCommand(){
		return $this->hasMany(ModelCommand::class);
	}

}
