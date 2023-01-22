
    <div class="row">
        <h1 class="col-12 text-center display-6">Nueva Categoria</h1>
    </div>
    <div class="row bg-gray-100">
        <form class="m-4 col-10" enctype="multipart/form-data" action="{{ route('categories.store') }}" method='POST'>
            @csrf
            <div class="form-group row">
                <label class="form-control-label col-12" for="name">Nom</label>
                <input type="text" name="name" id="title" class="form-control-input col-9" value="{!! old('name') !!}" required>
                @if ($errors->has('name'))
                    <div class="text-danger">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>
            <div class="form-group row">
                <label class="form-control-label col-12" for='photo'>Foto</label>
                <input class="form-control-input" type='file' name='photo' id="photo" required>
                @if ($errors->has('photo'))
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


