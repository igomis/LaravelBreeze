@extends('layouts.plantilla')
@section('titulo', 'Inici')
@section('contenido')
        @if (Route::has('login'))
            <div class="float-right navbar-dark" style="height:100px; transform: translateY(-60px); position: sticky; top: 130px; z-index: 11">
                @auth
                    <a class="navbar-text" href="{{ url('/dashboard') }}">{{auth()->user()->name}}</a>
                    <a class="navbar-text" href="{{ route('logout.get') }}">Logout</a>

                @else
                    <a class="navbar-text m-2" href="{{ route('login') }}">Log in</a>

                    @if (Route::has('register'))
                        <a class="navbar-text" href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            </div>
        @endif

    <section class="h-100 gradient-custom">
        <div class="container py-5">
            <div class="row d-flex justify-content-center my-4">
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <!-- Single item -->
                            @foreach($gangas as $ganga)
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
                                        <!-- Data -->
                                    </div>

                                    <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                                        <!-- Quantity -->
                                        <div class="d-flex mb-4" style="max-width: 300px">
                                           <p><strong>Categoría: </strong> {{$ganga->category->name}}</p>
                                        </div>
                                        <div class="d-flex mb-4" style="max-width: 300px">
                                            <button class="btn btn-warning">
                                                <a href="{{route("gangas.show", $ganga)}}"><i class="bi bi-eye"></i></a>
                                            </button>
                                        </div>

                                        <!-- Price -->

                                            <p class="text-start text-right">
                                                <strong><del>{{$ganga->price}}</del></strong>
                                                <strong class="text-danger">{{$ganga->price_sale}}€</strong>
                                            </p>

                                        <!-- Price -->
                                    </div>
                                </div>
                                    <hr class="my-4" />
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                {{$gangas->links()}}
            </div>
        </div>
    </section>
   @endsection


