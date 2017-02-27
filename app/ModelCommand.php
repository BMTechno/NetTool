<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelCommand extends Model
{
    
	protected $table = 'models_commands';

	protected $fillable = [
		'model_id', 'command_id',
	];

	public function deviceModel()
    {
        return $this->belongsTo(DeviceModel::class);
    }

   	public function command()
    {
        return $this->belongsTo(Command::class);
    }


}
