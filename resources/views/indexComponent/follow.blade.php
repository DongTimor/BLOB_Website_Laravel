<div class="card mt-3">
    <div class="card-header pb-0 border-0">
        <h5 class="">Follower</h5>
    </div>
    <div class="card-body" style="max-height: 500px;overflow-y: auto;">
        @auth
            @foreach (auth()->user()->followed as $item)
                {{-- {{ dd($item->followable) }} --}}
                <div class="hstack gap-2 mb-3" name="follow_card">
                    <div class="avatar">
                        <img style="max-width: 45px; max-height: 45px;" class="avatar1"
                             src="{{ $item->followable->getAvatarImage() }}" alt="{{ $item->name }}">
                    </div>
                    <div class="overflow-hidden">
                        <a class="h6 mb-0" href="{{ route("user.show", ['user'=>$item->followable->id]) }}">{{ $item->followable->name }}</a>
                        <p class="mb-0 small text-truncate">&commat; {{ $item->followable->name }}</p>
                    </div>
                    <div class="ms-auto">
                        <form action="{{ route('unfollow', $item->followable) }}" method="post">
                            @csrf
                            <button type="submit" class="rounded-circle unfollow-btn">
                                <span class="minus-icon">-</span>
                            </button>
                        </form>
                    </div>
                </div>

            @endforeach
        @endauth
        @guest
            <div style="text-align: center" class="">Login now</div>
        @endguest


        <div class="d-grid mt-3">
            <a class="btn btn-sm btn-primary-soft" href="#">Show More</a>
        </div>
    </div>
</div>
