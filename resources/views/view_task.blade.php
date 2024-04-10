@extends('layouts.main')

@section('content')

    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col">
                <form action="{{route('tasks.update', $task->id)}}" method="POST">
                    <div class="row">
                        <div class="col-sm-4 offset-sm-4">
                            <div class="mb-3">
                                <label for="title" class="form-label">Titulo</label>
                                <input disabled type="text" value="{{$task->title}}" class="form-control" name="title" id="title">
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label">data de criação</label>
                                <input disabled type="data" value="{{$task->created_at->format('d/m/Y')}}" class="form-control" name="title" id="title">
                            </div>
                            <div class="mb-3">
                                <label for="descricao" class="form-label">descricao</label>
                                <textarea disabled class="form-control" name="description" id="description" cols="30" rows="5">{{$task->description}}</textarea>
                            </div>
                            <a href="{{route('tasks.index')}}" class="btn btn-secondary">Voltar</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection
