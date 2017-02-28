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
	/**
    * The method for making a connection
    *
    * @var EquipmentRepository
    */
    public function getConnect($host, $username, $password){

    	//Configuration of the connection
    	$connection = new Remote([
    		'host' => $host,
    		'port' => '22',
    		'username' => $username,
    		'password' => $password,
    	]);

    	//standart error check
    	if ($error = $connection->getStdError()) {
            throw new Exception("Houston, we have a problem: $error");
        }
    }
}
