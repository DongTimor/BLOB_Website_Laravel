<nav class="navbar navbar-expand-lg bg-dark border-bottom border-bottom-dark ticky-top bg-body-tertiary"
    data-bs-theme="dark">
    <div class="container">
        {{-- <a class="navbar-brand fw-light" href="/content"><span class="fas fa-brain me-1"> </span>BLOB</a> --}}
        <a class="navbar-brand fw-light" href="/clear-session-and-redirect" ">
            <span class="fas fa-brain me-1 "> </span>BLOB
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                @guest
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/register">Register</a>
                    </li>
                @endguest
                @auth


                    <img style="width:40px; height:40px" class="avatar1" src="{{ auth()->user()->getAvatarImage() }}"
                    alt="{{ auth()->user()->name }} Avatar">
                    <li class="nav-item">
                        <a class="nav-link " style="font-size: 22px;" href="{{ route("profile") }}">{{ Auth::user()->name }}</a>
                    </li>

                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </form>
                @endauth

            </ul>
        </div>
    </div>
</nav>
