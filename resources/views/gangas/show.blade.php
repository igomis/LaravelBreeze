@extends('layouts.plantilla')
@section('titulo', 'Ver Ganga')
@section('contenido')
<div class="row m-30">
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
        <div class="row">
            @if($voto)
                <div class="m-1">
                    <form method="POST" action="{{route('gangas.like', $ganga->id)}}">
                        @method('PUT')
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm me-1 mb-2"
                                title="Like"  @if($voto->vote) disabled @endif>
                            <i class="bi bi-hand-thumbs-up"></i>
                            <div>{{$ganga->likes}}</div>
                        </button>
                    </form>
                </div>
                <div class="m-1">
                    <form method="POST" action="{{route('gangas.unlike', $ganga->id)}}">
                        @method('PUT')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm me-1 mb-2"
                                title="Unlike"  @if(!$voto->vote) disabled @endif>
                            <i class="bi bi-hand-thumbs-down"></i>
                            <div>{{$ganga->unlikes}}</div>
                        </button>
                    </form>
                </div>
                <div class="ml-10" style="transform: translateX(200px)">
                    <p class="text-start text-right">
                        <strong><del>{{$ganga->price}}</del></strong>
                        <strong class="text-danger">{{$ganga->price_sale}}€</strong>
                    </p>
                </div>
            @else
                <div class="m-1">
                    <form method="POST" action="{{route('gangas.like', $ganga->id)}}">
                        @method('PUT')
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm me-1 mb-2"
                                title="Like" @if(!Auth::check()) disabled @endif>
                            <i class="bi bi-hand-thumbs-up"></i>
                            <div>{{$ganga->likes}}</div>
                        </button>
                    </form>
                </div>
                <div class="m-1">
                    <form method="POST" action="{{route('gangas.unlike', $ganga->id)}}">
                        @method('PUT')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm me-1 mb-2"
                                title="Unlike" @if(!Auth::check()) disabled @endif>
                            <i class="bi bi-hand-thumbs-down"></i>
                            <div>{{$ganga->unlikes}}</div>
                        </button>
                    </form>
                </div>

            @endif



            <!-- Price -->

            <!-- Price -->
        </div>


        <!-- Data -->
    </div>

    <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
        <!-- Quantity -->
        <div class="d-flex mb-4" style="max-width: 300px">
            <p><strong>Categoría: </strong> {{$ganga->category->name}}</p>
        </div>
        @if(Auth::check())
            @if(Auth::id() == $ganga->user->id || (Auth::user()->rol === 'admin'))
                <button class="btn btn-warning">
                    <a href="{{route('gangas.edit', $ganga)}}"><i class="bi bi-pencil"></i></a>
                </button>
                <form action="{{route('gangas.destroy', $ganga)}}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
                </form>
            @endif
        @endif

        <!-- Quantity -->


    </div>
</div>
@endsection
