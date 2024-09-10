<div class="card overflow-hidden">
    <div class="card-body pt-3">
        <ul class="nav nav-link-secondary flex-column fw-bold gap-2">
            <li class="nav-item">
                <a class="nav-link text-dark" href="/clear-session-and-redirect">
                    <span>Home</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span>Explore</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span>Feed</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span>Terms</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span>Support</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span>Settings</span></a>
            </li>
        </ul>
    </div>

    @auth
    @if (!auth()->user()->isManager() && !auth()->user()->isAdmin())
    <div class="card-footer text-center py-2">
        <a class="btn btn-link btn-sm" href="/profile">Profile</a>
    </div>

    @else
    <div class="card-footer text-center py-2">
        <a class="btn btn-link btn-sm text-danger " style="font-size: 17px" href="/app">>> Managerment Panel << </a>
    </div>
    @endif

    @endauth
    @guest
    <div class="card-footer text-center py-2">
        <a class="btn btn-link btn-sm" href="/profile">Profile</a>
    </div>
    @endguest



</div>

