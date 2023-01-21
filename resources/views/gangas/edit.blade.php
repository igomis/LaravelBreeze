@extends('layouts.plantilla')
@section('titulo', 'Editar Ganga')
@section('contenido')
    <div>
        <h1 class="text-center display-4">Editar Ganga</h1>
    </div>
    <div class="row bg-gray-100">
        <form class="offset-3 mt-4 col-5" enctype="multipart/form-data" action="{{ route('gangas.update', $ganga->id) }}" method='POST'>
            @csrf
            @method('PUT')
            <div class="form-group row">
                <label class="form-control-label col-3" for="title">Titol</label>
                <input type="text" name="title" id="title" class="form-control-input col-9" value="{{$ganga->title}}" required>
                @if ($errors->has('title'))
                    <div class="text-danger">
                        {{ $errors->first('title') }}
                    </div>
                @endif
            </div>
            <div class="form-group row">
                <label class="form-control-label col-3" for='description'>Descripció</label>
                <input class="form-control-input col-9" type='text' name='description' id="description" value="{{$ganga->description}}" required>
                @if ($errors->has('description'))
                    <div class="text-danger">
                        {{ $errors->first('description') }}
                    </div>
                @endif
            </div>
            <div class="form-group row">
                <label class="form-control-label col-3" for='photo'>Foto</label>
                <input class="form-control-input" type='file' name='new_photo' id="photo">
                @if ($errors->has('new_photo'))
                    <div class="text-danger">
                        {{ $errors->first('new_photo') }}
                    </div>
                @endif
            </div>
            <div class="form-group row">
                <label class="form-control-label col-3" for='url'>Url</label>
                <input class="form-control-input col-9" type='text' name='url' id="url" value="{{$ganga->url}}" required>
                @if ($errors->has('url'))
                    <div class="text-danger">
                        {{ $errors->first('url') }}
                    </div>
                @endif
            </div>
            <div class="form-group row">
                <label class="form-control-label col-3" for='category_id'>Categoría</label>
                <select class="form-control-select col-9" type='text' name='category_id' id="category_id" value="{{$ganga->category_id}}" required>
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
                <input class="form-control-input col-5" type='number' name='price' id="price" value="{{$ganga->price}}" required>
                @if ($errors->has('price'))
                    <div class="text-danger">
                        {{ $errors->first('price') }}
                    </div>
                @endif
            </div>
            <div class="form-group row">
                <label class="form-control-label col-3" for='price_sale'>Preu venta</label>
                <input class="form-control-input col-5" type='number' name='price_sale' id="price_sale" value="{{$ganga->price_sale}}" required>
                @if ($errors->has('price_sale'))
                    <div class="text-danger">
                        {{ $errors->first('price_sale') }}
                    </div>
                @endif
            </div>
            <div class="form-group row">
                <label class="form-control-label col-3" for='available'>Disponible</label>
                <input class="form-control-input" type='checkbox' name='available' id="available" @if($ganga->available == 1) checked @endif>
            </div>

            <div class="form-group text-center">
                <button type="submit" class="btn btn-danger">Editar ganga</button>
            </div>
        </form>
    </div>

@endsection
