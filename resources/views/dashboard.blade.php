@extends('layouts.main')


@section('content')

    <div class="container-fluid">
        <header class="text-center ">
            <h1 class="display-4">Todo List</h1>
        </header>
        <div class="row py-5">
            <div class="col-lg-10 mx-auto">
                <div class="card rounded shadow border-0">
                    <div class="card-body p-5 bg-white rounded">
                        <a href="{{route('tasks.create')}}" class="btn btn-primary mb-3">Nova task</a>

                        <form action="{{route('tasks.index')}}" method="get" class="mb-4">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="title">Titulo</label>
                                    <input name="title" id="title" type="text" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label for="status_id">Status</label>
                                    <select name="status_id" id="status_id" class="form-select">
                                        <option value="">Selecionae o status</option>
                                        <option value="1">Ativo</option>
                                        <option value="2">Em progresso</option>
                                        <option value="3">Concluido</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <br/>
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table id="emp-table" style="width:100%" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>task titulo</th>
                                        <th>status</th>
                                        <th>actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tasks as $task)
                                        <tr>
                                            <td style="width: 50%">
                                                {{$task->title}}
                                            </td>
                                            <td>
                                                <span style="background-color: {{$task->color}};" class="badge py-2 text-dark">{{$task->name}}</span>
                                            </td>
                                            <td>
                                                @switch($task->status_id)
                                                    @case(1)
                                                        <a href="{{route('tasks.alter_status', ['task_id'=> $task->id, 'status_id' => 2])}}" class="btn btn-warning mt-2 mt-md-0" data-bs-toggle="tooltip" data-bs-title="Iniciar Task"><span style="font-size: 20px;" class="material-icons">directions_run</span></a>
                                                        <a href="{{route('tasks.edit', $task->id)}}" class="btn btn-warning mt-2 mt-md-0" data-bs-toggle="tooltip" data-bs-title="Editar Task"><span style="font-size: 20px;" class="material-icons">edit</span></a>
                                                        @break
                                                    @case(2)
                                                        <a href="{{route('tasks.alter_status', ['task_id'=> $task->id, 'status_id' => 1])}}" class="btn btn-warning mt-2 mt-md-0" data-bs-toggle="tooltip" data-bs-title="Parar Task"><span style="font-size: 20px;" class="material-icons">pan_tool</span></a>
                                                        <a href="{{route('tasks.alter_status', ['task_id'=> $task->id, 'status_id' => 3])}}" class="btn btn-success mt-2 mt-md-0" data-bs-toggle="tooltip" data-bs-title="Concluir Task"><span style="font-size: 20px;" class="material-icons">done_outline</span></a>
                                                        @break
                                                    @case(3)
                                                        <a href="{{route('tasks.alter_status', ['task_id'=> $task->id, 'status_id' => 1])}}" class="btn btn-success mt-2 mt-md-0" data-bs-toggle="tooltip" data-bs-title="Reabrir Task"><span style="font-size: 20px;" class="material-icons">open_in_new</span></a>
                                                        @break
                                                    @default
                                                @endswitch
                                                <a href="{{route('tasks.show', $task->id)}}" class="btn btn-info mt-2 mt-md-0" data-bs-toggle="tooltip" data-bs-title="Vizualizar Task"><span style="font-size: 20px;" class="material-icons">visibility</span></a>
                                                <a href="{{route('tasks.delete', $task->id)}}" class="btn btn-danger mt-2 mt-md-0" data-bs-toggle="tooltip" data-bs-title="Excluir Task">
                                                    <span style="font-size: 20px;" class="material-icons">delete</span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')

<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>
@endsection
