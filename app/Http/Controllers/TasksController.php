<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Tasks;

class TasksController extends Controller
{

    public function __construct(
        protected Tasks $repository,
    ) {

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return "ola";
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
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao cadastrar o task.',
                'erros' => $validator->errors()->all()
            ], 401);
        }

        $task = $this->repository->create($data);

        return response()->json([
            'data' => $task,
            'state' => 'created'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Valid if login was sent.
     */
    private function validator($data)
    {
        return Validator::make($data, [
            'titulo' => 'required|string',
            'descricao' => 'required|string',
        ], [
            'titulo.required' => 'O titulo é obrigatório',
            'descricao.required' => 'A descricao é obrigatória',
        ]);
    }
}
