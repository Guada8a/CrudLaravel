@extends('layouts.base')

@section('content')
<div class="row">
    <div class="col-12">
        <div>
            <h2 class="text-white">CRUD</h2>
        </div>
        <div>
            <a href="{{route('tasks.create')}}" class="btn btn-primary"><span class="fs-6"><x-fas-plus-circle/></span>Nueva tarea</a>
        </div>
    </div>
    @if(Session::get('success'))
        <div class="alert alert-success mt-2">
            {{Session::get('success')}}
        </div>
    @endif
    <div class="col-12 mt-4">
        @if($tasks->isEmpty())
            <div class="alert alert-warning">
                No hay tareas
            </div>
        @else
        <table class="table table-bordered text-white">
            <tr class="text-secondary">
                <th>Tarea</th>
                <th>Descripción</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Acción</th>
            </tr>
            @foreach ($tasks as $task)
                <tr>
                    <td class="fw-bold">{{$task->title}}</td>
                    <td>{{$task->description}}</td>
                    <td>
                        <span class="badge bg-secondary fs-6">{{$task->due_date}}</span>
                    </td>
                    <td>
                        @if ($task->status == 'Pendiente')
                            <span class="badge bg-danger fs-6">{{$task->status}}</span>
                        @elseif($task->status == 'En progreso')
                            <span class="badge bg-warning fs-6">{{$task->status}}</span>
                        @else
                            <span class="badge bg-success fs-6">{{$task->status}}</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{route('tasks.edit',$task->id)}}" class="btn btn-warning">Editar</a>

                        <form action="{{route('tasks.destroy', $task)}}" method="post" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        {{$tasks->links()}}
        @endif
    </div>
</div>
@endsection