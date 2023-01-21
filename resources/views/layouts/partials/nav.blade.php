<nav class="col-10 navbar navbar-dark bg-dark">
    <ul>
        <li class="navbar-text">
            <a href="{{route("gangas.index")}}">Inici</a>
        </li>
        <li class="navbar-text">Nous</li>
        <li class="navbar-text">Destacats</li>

        @if(Auth::check())
            @if(Auth::check() || (Auth::user()->rol === 'admin'))
                <li class="navbar-text">
                    <a href="{{route("gangas.create")}}">Crear ganga</a>
                </li>
                <li class="navbar-text">
                    <a href="{{route("gangas.user")}}">Tus gangas</a>
                </li>
            @endif
        @endif

    </ul>
</nav>
