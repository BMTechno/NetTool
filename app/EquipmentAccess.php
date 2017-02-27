<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EquipmentAccess extends Model
{
    protected $table = "equipments_accesses";

    protected $fillable = [
    'ssh_user' , 'ssh_password', 
    ];

    protected $casts = [
        'equipment_id' => 'int',
    ];

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }
}
