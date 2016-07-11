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
        'equipment_alias' , 'ssh_user', 'ip_adress', 
    ];

    protected $hidden = [
        'ssh_pass', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
