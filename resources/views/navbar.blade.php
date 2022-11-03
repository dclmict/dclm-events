<nav class="navbar shadow sticky-top navbar-expand-lg navbar-light bg-light border-dark bg-white">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">
            {{-- <img class="img-fluid" width="40"
                src="/logo.jpg" alt="Logo"
                srcset=""> --}}
            <span class="navbrand-header-text">Events </span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03"
            aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('programs.index') }}">Programs</a>
                    </li>                
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.registration-data') }}">Registration</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('continents.index') }}">Continent</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('countries.index') }}">Country</a>
                    </li>
                    <li class="nav-item">
                        <form method="post" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn nav-link">Logout</button>
                        </form>
                    </li>
                @endauth
            </ul>
            <div class="d-flex">
                <a class="nav-link text-dark" href="https://dclm.org/">
                    <i class="fa fa-external-link" aria-hidden="true"></i>
                </a>
                <a class="nav-link text-dark" href="https://dclm.org/">
                    <i class="fa fa-twitter " aria-hidden="true"></i>
                </a>
                <a class="nav-link text-dark" href="#">
                    <i class="fa fa-facebook " aria-hidden="true"></i>
                </a>
                <a class="nav-link text-dark" href="#">
                    <i class="fa fa-instagram " aria-hidden="true"></i>
                </a>
                <a class="nav-link text-dark" href="#">
                    <i class="fa fa-youtube " aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>
</nav>
