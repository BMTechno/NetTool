<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Equipment;
use App\DeviceModel;
use App\EquipmentAccess;
use App\Repositories;
class EquipmentController extends Controller
{
    /**
     * The task repository instance.
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
     * Display a list of all of the user's task.
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
     * Create a new task.
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
        ]);
        $equipment = $request->user()->equipments()->create([
            'equipment_name' => $request->equipment_name,
            'ip_address' => $request->ip_address,
        ]);
        $equipmentAccess->equipment_id = $equipment->id;
        $equipmentAccess->ssh_user = $request->ssh_user;
        $equipmentAccess->ssh_password = $request->ssh_password;
        $equipmentAccess->save();

        // $request->user()->equipments()->equipmentAccess()->create([
        //     'ssh_user' => $request->ssh_user,
        //     'ssh_password' => $request->ssh_password,
        // ]);
        //var_dump($request->user()->equipments());
        return redirect('/equipment');
    }
    /**
     * Destroy the given task.
     *
     * @param  Request  $request
     * @param  Equipment  $equipment
     * @return Response
     */
    public function destroy(Request $request, Equipment $equipment)
    {
        $this->authorize('destroy', $equipment);

        $equipmentAccess = EquipmentAccess::where('equipment_id', $equipment->id)->first();
        //$this->authorize('destroy', $equipmentAccess);
        $equipmentAccess->delete();
        $equipment->delete();
        return redirect('/equipment');
    }
}