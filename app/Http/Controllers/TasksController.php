<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Tasks;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{


    /**
     * Constructor
     *
     * @param models $repository
     */
    public function __construct(
        protected Tasks $repository,
    ) {

    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = $request->title;
        $status_id = $request->status_id;

        $status = new Status;
        $data = $this->repository
            ->when($title, function($q, $title){
                $q->where('title', $title);
            })
            ->when($status_id, function($q, $status_id){
                $q->where('status_id', $status_id);
            })
            ->where('status_id', '<>', 4)
            ->leftJoin('status_task', 'tasks.status_id', '=', 'status_task.id')
            ->select('tasks.*', 'status_task.color', 'status_task.name')
            ->get();

        return view("dashboard", ['tasks' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("new_task");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $user = Auth::user();

        $data['user_id'] = $user['id'];
        $data['email'] = $user['email'];
        $data['status_id'] = '1';

        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return redirect()->route('tasks.create')->with('error', $validator->errors()->all());
        }

        $task = $this->repository->create($data);

        return redirect()->route('tasks.index')->with('success', 'Task criada!');
    }

    /**
     * Shows the task data visualization
     */

    public function show(string $id){
        $data = $this->repository->find($id);

        return view('view_task', ['task' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = $this->repository->find($id);

        return view('edit_task', ['task' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $task = $this->repository->findOrFail($id);
        $data = $request->all();
        $validator = $this->validator($data);

        if ($validator->fails()) {
            return redirect()->route('tasks.edit', $id)->with('error', $validator->errors()->all());
        }

        $task->update($data);

        return redirect()->route('tasks.index')->with('success', 'Task atualizada!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = $this->repository->findOrFail($id);
        $task->delete();
        $task->update(['status_id' => 3]);

        return redirect()->route('tasks.index')->with('success', 'Task excluida!');
    }


    /**
     * Change status as per given status_id
     */
    public function alter_status($task_id, $status_id){
        $task = $this->repository->findOrFail($task_id);
        $task->status_id = $status_id;

        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Status da task atualizado!');
    }

    /**
     * Valid if data was sent.
     */
    private function validator($data)
    {
        return Validator::make($data, [
            'title' => 'required|string',
            'description' => 'required|string',
        ], [
            'title.required' => 'O titulo é obrigatório',
            'description.required' => 'A descricao é obrigatória',
        ]);
    }
}
