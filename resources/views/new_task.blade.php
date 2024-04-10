@extends('layouts.main')

@section('content')

    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col">
                <form action="{{route('tasks.store')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-sm-4 offset-sm-4">

                            <div class="mb-3">
                                <label for="title" class="form-label">Titulo</label>
                                <input type="text" class="form-control" name="title" id="title">
                            </div>
                            <div class="mb-3">
                                <label for="descricao" class="form-label">descricao</label>
                                <textarea class="form-control" name="description" id="description" cols="30" rows="5"></textarea>
                            </div>
                            <a href="{{route('tasks.index')}}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection
