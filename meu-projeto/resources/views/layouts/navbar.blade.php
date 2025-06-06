<nav class="navbar navbar-expand-lg bg-body-secondary">
    <div class="container-fluid">

        <a class="navbar-brand" href="{{ url('/home') }}">Home</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        ≡
                    </a>
                    <ul class="dropdown-menu">
                        <li class="nav-item"><a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a></li>
                        <li class="nav-item">
                            <form class="dropdown-item" method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item btn btn-link" style="display: inline; padding: 0; border: none; background: none;">{{ __('Log Out') }}</button>
                            </form>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/alunos') }}">Alunos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/cursos') }}">Cursos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/turmas') }}">Turmas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/nivels') }}">Níveis</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ '/adm/solicitacoes' }}">Solicitações</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ '/relatorios/horas' }}">Graficos</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Mais
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('comprovantes.index') }}">Comprovantes</a></li>
                        <li><a class="dropdown-item" href="{{ route('declaracoes.index') }}">Declarações</a></li>
                        <li><a class="dropdown-item" href="{{ route('documentos.index') }}">Documentos</a></li>
                        <li><a class="dropdown-item" href="{{ route('categorias.index') }}">Categorias</a></li>
                    </ul>

                </li>
            </ul>

            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Pesquisar" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Buscar</button>
            </form>

        </div>
    </div>
</nav>