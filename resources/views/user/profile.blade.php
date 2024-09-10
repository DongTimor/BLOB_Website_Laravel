<div class="card">
    <div class="px-3 pt-4 pb-2">
        <div class="d-flex align-items-center justify-content-between">

            <div class="d-flex align-items-center">
                <style>

                </style>
                <img class="avatar1" src="{{ $user->getAvatarImage() }}" alt="{{ $user->name }}">
                <div>
                    <h3 class="card-title mb-0"><a href="#"> {{ $user->name }}
                        </a></h3>
                    <span class="text-muted">@</span>
                    <span class="fs-6 text-muted ml-3">{{ $user->name }}</span>
                </div>
            </div>
            @if (auth()->user()->id == $user->id)
                <div class="mb-5">
                    <a href="{{ route('user.edit', $user) }}">edit</a>
                </div>
            @endif

        </div>
        <div class="px-2 mt-4">
            <h5 class="fs-5"> Bio : </h5>
            <p class="fs-6 fw-light">
                {{ $user->bio }}
            </p>
            <div class="d-flex justify-content-start">
                <a href="#" class="fw-light nav-link fs-6 me-3"> <span class="fas fa-user me-1">
                    </span> {{ $user->followee()->count() }} Followers </a>
                <a href="#" class="fw-light nav-link fs-6 me-3"> <span class="fas fa-brain me-1">
                    </span> {{ $user->content()->count() }} </a>
                <a href="#" class="fw-light nav-link fs-6"> <span class="fas fa-comment me-1">
                    </span> {{ $user->comment()->count() }} </a>
            </div>
            @if (auth()->user()->id != $user->id)
            @if (auth()->user()->follows($user))

            <form action="{{ route("unfollow",$user) }}" method="post" >
                @csrf
                <div class="mt-3">
                    <button type="submit" class="btn btn-secondary btn-sm"> UnFollow </button>
                </div>
            </form>
            @else
            <form action="{{ route("follow",$user) }}" method="post" >
                @csrf
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary btn-sm"> Follow </button>
                </div>
            </form>
            @endif

            @endif

        </div>
    </div>

</div>
<hr>
<div class="mb-5"></div>
@foreach ($user->content() as $item)
    @include('indexComponent.content')
@endforeach
{{ $user->content()->links() }}
