<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use PhanAn\Remote\Remote;
use App\Equipment;
use App\DeviceModel;
use App\Command;
use App\ModelCommand;
use App\EquipmentAccess;
use App\Repositories;
class EquipmentController extends Controller
{
    /**
     * The equipment repository instance.
     *
     * @var EquipmentRepository
     */
    protected $equipments;
    /**
     * Create a new controller instance.
     *
     * @param  EqipmentRepository  $equipments
     * @return void
     */
    public function __construct(\App\Repositories\EquipmentRepository $equipments)
    {
        $this->middleware('auth');
        $this->equipments = $equipments;
    }
    /**
     * Display a list of all of the user's equipments.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        return view('equipments.index', [
            'equipments' => $this->equipments->forUser($request->user()),
            'deviceModels' => DeviceModel::all(),
        ]);
    }
    /**
     * Display a personal page for any equipment
     *
     * @param  Request  $request, $id
     * @return Response
     */
    public function view (Request $request, $id) 
    {
        return view('equipments.info', [
            'equipments' => $this->equipments->forUser($request->user()),
            'id' => $id,
            'deviceModels' => DeviceModel::all(),
            'commands' => Command::all(),
            'modelCommands' => ModelCommand::all(),
            'ip' => '',
        ]);
    }
    /**
     * Create a new equipment.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $equipmentAccess = new EquipmentAccess();
        $this->validate($request, [
            'ssh_user' => 'required|max:255',
            'ssh_password' => 'required|max:255',
            'equipment_name' => 'required|max:255',
            'ip_address' => 'required|max:255',
            'model_name' => 'required|max:255',
        ]);

        $equipment = $request->user()->equipments()->create([
            'equipment_name' => $request->equipment_name,
            'ip_address' => $request->ip_address,
            'model_id' => $request->model_name,
        ]);

        $equipmentAccess->equipment_id = $equipment->id;
        $equipmentAccess->ssh_user = $request->ssh_user;
        $equipmentAccess->ssh_password = $request->ssh_password;
        $equipmentAccess->save();

        return redirect('/equipment');
    }
    /**
     * Destroy the given equipment.
     *
     * @param  Request  $request
     * @param  Equipment  $equipment
     * @return Response
     */
    public function destroy(Request $request, Equipment $equipment)
    {
        $this->authorize('destroy', $equipment);

        $equipmentAccess = EquipmentAccess::where('equipment_id', $equipment->id)->first();
        $equipmentAccess->delete();
        $equipment->delete();
        return redirect('/equipment');
    }

    public function connect(Request $request, Equipment $equipment)
    {
        try {
            $connection = new Remote([
             'host' => $equipment->ip_address,
             'port' => 22,
             'username' => EquipmentAccess::where('equipment_id', $equipment->id)->first()->ssh_user,
             'password' => EquipmentAccess::where('equipment_id', $equipment->id)->first()->ssh_password,
        ]);
        $command = $request->command . ' ' . $request->argv;
        $ip = $connection->exec($command);
        } catch (Exception $e){
            echo "Houston, we have a problem:" . $e;
        }

        return view('equipments.info', [
            'equipments' => $this->equipments->forUser($request->user()),
            'id' => $equipment->id,
            'deviceModels' => DeviceModel::all(),
            'commands' => Command::all(),
            'modelCommands' => ModelCommand::all(),
            'ip' => $ip,
        ]); 
    }
}