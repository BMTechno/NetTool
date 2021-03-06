<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'equipment_name' , 'ip_address', 'model_id',
    ];

    protected $table = "equipments";

    protected $casts = [
        'user_id' => 'int',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function equipmentAccess()
    {
        return $this->hasOne(EquipmentAccess::class);
    }
}
