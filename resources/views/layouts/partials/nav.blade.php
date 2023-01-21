<nav class="col-8 navbar navbar-dark bg-dark">
    <ul>
        <li class="navbar-text p-4">
            <a href="{{route("gangas.index")}}">Inici</a>
        </li>
        <li class="navbar-text p-4">
            <a href="{{route("gangas.nuevas")}}">Nous</a>
        </li>
        <li class="navbar-text p-4">
            <a href="{{route("gangas.mejores")}}">Destacats</a>
        </li>

        @if(Auth::check())
            @if(Auth::check() || (Auth::user()->rol === 'admin'))
                <li class="navbar-text p-4">
                    <a href="{{route("gangas.create")}}">Crear ganga</a>
                </li>
                <li class="navbar-text p-4">
                    <a href="{{route("gangas.user")}}">Les teues ganges</a>
                </li>
            @endif
        @endif

    </ul>
</nav>
