@extends('layouts.plantilla')
@section('titulo', 'Best-Gangas')
@section('contenido')
    <h1 class="text-center display-4">Categorías</h1>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <table class="table table-striped table-hover table-responsive">
                <thead class="bg-dark">
                <tr class="text-white text-center">
                    <th scope="col">Foto</th>
                    <th scope="col">Id</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Accions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr class="text-center">
                        <th scope="row">
                            <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">
                                <img src="{{ asset('storage/img/' . $category->image) }}"
                                     class="w-50" alt="{{$category->name}}" />
                            </div>
                        </th>
                        <td>{{$category->id}}</td>
                        <td>{{$category->name}}</td>
                        <td>
                            <button class="btn btn-warning">
                                <a href="{{route('categories.edit', $category)}}"><i class="bi bi-pencil"></i></a>
                            </button>
                            <form action="{{route('categories.destroy', $category)}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table>
        </div>
    </div>


@endsection
