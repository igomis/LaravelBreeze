@extends('layouts.plantilla')
@section('titulo', 'Crear Ganga')
@section('contenido')
    <div class="row">
        <h1 class="text-center display-4">Nueva Ganga</h1>
    </div>
    <div class="row bg-gray-100">
    <form class="offset-3 mt-4 col-5" enctype="multipart/form-data" action="{{ route('gangas.store') }}" method='POST'>
        @csrf
        <div class="form-group row">
            <label class="form-control-label col-3" for="title">Titol</label>
            <input type="text" name="title" id="title" class="form-control-input col-9" value="{!! old('title') !!}" required>
            @if ($errors->has('title'))
                <div class="text-danger">
                    {{ $errors->first('title') }}
                </div>
            @endif
        </div>
        <div class="form-group row">
            <label class="form-control-label col-3" for='description'>Descripció</label>
            <input class="form-control-input col-9" type='text' name='description' id="description" value="{!! old('description') !!}" required>
            @if ($errors->has('description'))
                <div class="text-danger">
                    {{ $errors->first('description') }}
                </div>
            @endif
        </div>
        <div class="form-group row">
            <label class="form-control-label col-3" for='photo'>Foto</label>
            <input class="form-control-input" type='file' name='photo' id="photo" required>
            @if ($errors->has('photo'))
                <div class="text-danger">
                    {{ $errors->first('photo') }}
                </div>
            @endif
        </div>
        <div class="form-group row">
            <label class="form-control-label col-3" for='url'>Url</label>
            <input class="form-control-input col-9" type='text' name='url' id="url" value="{!! old('url') !!}" required>
            @if ($errors->has('url'))
                <div class="text-danger">
                    {{ $errors->first('url') }}
                </div>
            @endif
        </div>
        <div class="form-group row">
            <label class="form-control-label col-3" for='category_id'>Categoría</label>
            <select class="form-control-select col-9" type='text' name='category_id' id="category_id" value="{!! old('category_id') !!}" required>
                <option value="" disabled selected>--Seleccione una categoría--</option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
            @if ($errors->has('category'))
                <div class="text-danger">
                    {{ $errors->first('category') }}
                </div>
            @endif
        </div>
        <div class="form-group row">
            <label class="form-control-label col-3" for='price'>Preu</label>
            <input class="form-control-input col-5" type='number' name='price' id="price" value="{!! old('price') !!}" required>
            @if ($errors->has('price'))
                <div class="text-danger">
                    {{ $errors->first('price') }}
                </div>
            @endif
        </div>
        <div class="form-group row">
            <label class="form-control-label col-3" for='price_sale'>Preu venta</label>
            <input class="form-control-input col-5" type='number' name='price_sale' id="price_sale" value="{!! old('price_sale') !!}" required>
            @if ($errors->has('price_sale'))
                <div class="text-danger">
                    {{ $errors->first('price_sale') }}
                </div>
            @endif
        </div>
        <div class="form-group row">
            <label class="form-control-label col-3" for='available'>Disponible</label>
            <input class="form-control-input" type='checkbox' name='available' id="available">
            @if ($errors->has('available'))
                <div class="text-danger">
                    {{ $errors->first('available') }}
                </div>
            @endif
        </div>

        <div class="form-group text-center">
            <button type="submit" class="btn btn-danger">Afegir ganga</button>
        </div>
    </form>
    </div>

@endsection
