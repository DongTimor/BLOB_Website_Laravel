<div class="card">
    <div class="card-header pb-0 border-0">
        <h5 class="">Search</h5>
    </div>
    <form method="get" action="{{ route("content.search") }}">
        @csrf
    <div class="card-body">
        <input name="search" id="search" placeholder="...
        " class="form-control w-100" type="text" id="search">
        <button class="btn btn-dark mt-2"> Search</button>
    </div>
</form>
</div>
