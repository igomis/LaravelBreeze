@extends('layouts.plantilla')
@section('titulo', 'Edit-Gangas')
@section('contenido')
    <div class="row">
        <h1 class="col-12 text-center display-6">Editar Categoria</h1>
    </div>
    <div class="row bg-gray-100">
        <form class="m-4 col-10" enctype="multipart/form-data" action="{{ route('categories.update', $category->id) }}" method='POST'>
            @csrf
            @method('PUT')
            <div class="form-group row">
                <label class="form-control-label col-12" for="name">Nom</label>
                <input type="text" name="name" id="title" class="form-control-input col-9" value="{{$category->name}}" required>
                @if ($errors->has('name'))
                    <div class="text-danger">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>
            <div class="form-group row">
                <label class="form-control-label col-12" for='new_photo'>Foto</label>
                <input class="form-control-input" type='file' name='new_photo' id="new_photo">
                @if ($errors->has('new_photo'))
                    <div class="text-danger">
                        {{ $errors->first('photo') }}
                    </div>
                @endif
            </div>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-danger">Afegir</button>
            </div>
        </form>
    </div>


@endsection
