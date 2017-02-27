<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeviceModel extends Model
{
    
	protected $table = 'device_models';

	protected $fillable = [
		'model_name', 
	];

	public function modelCommand(){
		return $this->hasMany(ModelCommand::class);
	}

}
