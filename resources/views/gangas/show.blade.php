@extends('layouts.plantilla')
@section('titulo', 'Ver Ganga')
@section('contenido')
<div class="row">
    <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
        <!-- Image -->
        <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">
            <img src="{{ asset('storage/img/' . $ganga->photo) }}"
                 class="w-100" alt="{{$ganga->title}}" />
            <a href="#!">
                <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
            </a>
        </div>
        <!-- Image -->
    </div>

    <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
        <!-- Data -->
        <p class="display-5"><strong>{{$ganga->title}}</strong></p>
        <p class="display-7">{{$ganga->description}}</p>
        <form method="POST" action="{{route('gangas.like', $ganga->id)}}">
            @method('PUT')
            @csrf
            <button type="submit" class="btn btn-primary btn-sm me-1 mb-2"
                    title="Like">
                <i class="bi bi-hand-thumbs-up"></i>
                <div>{{$ganga->likes}}</div>
            </button>
        </form>
        <form method="POST" action="{{route('gangas.unlike', $ganga->id)}}">
            @method('PUT')
            @csrf
            <button type="submit" class="btn btn-danger btn-sm me-1 mb-2"
                    title="Like">
                <i class="bi bi-hand-thumbs-down"></i>
                <div>{{$ganga->unlikes}}</div>
            </button>
        </form>

        <!-- Data -->
    </div>

    <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
        <!-- Quantity -->
        <div class="d-flex mb-4" style="max-width: 300px">
            <p><strong>Categoría: </strong> {{$ganga->category->name}}</p>
        </div>
        @if(Auth::check())
            @if(Auth::id() == $ganga->user->id || (Auth::user()->rol === 'admin'))
                <a href="{{route('gangas.edit', $ganga)}}">Editar</a>
                <form action="{{route('gangas.destroy', $ganga)}}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button>Borrar</button>
                </form>
            @endif
        @endif

        <!-- Quantity -->

        <!-- Price -->
        <p class="text-start text-md-center">
            <strong>{{$ganga->price_sale}}</strong>
        </p>
        <!-- Price -->
    </div>
</div>
@endsection
