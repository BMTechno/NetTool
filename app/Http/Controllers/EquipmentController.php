<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Equipment;
class TaskController extends Controller
{
    /**
     * The task repository instance.
     *
     * @var TaskRepository
     */
    protected $equipments;
    /**
     * Create a new controller instance.
     *
     * @param  TaskRepository  $equipments
     * @return void
     */
    public function __construct(TaskRepository $equipments)
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
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);
        $request->user()->equipments()->create([
            'name' => $request->name,
        ]);
        return redirect('/equipments');
    }
    /**
     * Destroy the given task.
     *
     * @param  Request  $request
     * @param  Task  $task
     * @return Response
     */
    public function destroy(Request $request, Task $task)
    {
        $this->authorize('destroy', $task);
        $task->delete();
        return redirect('/equipments');
    }
}