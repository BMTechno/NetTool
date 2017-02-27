<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Exception;
use PhanAn\Remote\Remote;
use App\Http\Requests;

use App\Equipment;
use App\EquipmentAccess;
use App\Repositories;

class RemoteController extends Controller
{
    public function getConnect(){

    	$connection = new Remote([
    		'host' => ,
    		'port' => '22',
    		'username' => ,
    		'password' => ,
    	]);

    }
}
