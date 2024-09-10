<div class="mt-3">
    <div class="card">
        <div class="px-3 pt-4 pb-2">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <img style="width:50px; height:50px" class="avatar1" src="{{ $item->user->getAvatarImage() }}"
                        alt="{{ $item->user->name }} Avatar">
                    <div>
                        <h5 class="card-title mb-0"><a href="{{ route('user.show', $item->user) }}">
                                {{ $item->user->name }}
                            </a></h5>

                    </div>

                </div>


                @auth
                @if (auth()->user()->id == $item->user_id)
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('content.show', $item) }}">view</a>
                    <a href="{{ route('content.edit', $item) }}">Edit</a>
                    <form method="post" action="{{ route('content.delete', $item) }}">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger btn-sm">X</button>
                    </form>
                </div>
                @else
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('content.show', $item) }}">view</a>

                </div>
                @endif
                @endauth
                @guest
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('content.show', $item) }}">view</a>

                </div>
                @endguest




            </div>
        </div>
        <div class="card-body">
            @if ($editting1 ?? false)
                <form action="{{ route('content.update', $item) }}" method="post">
                    @csrf
                    @method('PUT')
                    <textarea class="fs-6 form-control mb-3" rows="1" name="content">{{ $item->content }}</textarea>
                    @if ($item->image != null)
                        <div style="max-width: 100%; margin-bottom: 15px;">
                            <img style="width: 100%;" src="{{ asset('storage/' . $item->image) }}"
                                alt="{{ $item->image }} Avatar">
                        </div>
                    @endif
                    <button class="btn btn-primary btn-sm">Update</button>
                </form>
            @else
                @if ($showing ?? false)
                    <p class="fs-6 fw-light text-muted">
                        {{ $item->content }}
                    </p>
                    @if ($item->image != null)
                        <div style="max-width: 100%;">
                            <img style="width: 100%;" src="{{ asset('storage/' . $item->image) }}"
                                alt="{{ $item->image }} Avatar">
                        </div>
                    @endif
                @else
                    <p class="fs-6 fw-light text-muted">
                        {{ $item->content }}
                    </p>
                    @if ($item->image != null)
                        <div style="max-width: 100%; max-height: 600px; overflow: hidden;">
                            <img style="width: 100%; height: auto; max-height: 600px; object-fit: cover;"
                                src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->image }} Avatar">
                        </div>
                    @endif

                @endif

            @endif

            <div class="d-flex justify-content-between mt-5">
                <div>
                    @auth
                    @if ($item->checkliked())
                    <form action="{{ route('unlike', $item) }}" method="post">
                        @csrf
                        @method('PUT')
                    <button type="submit" class="fw-light nav-link fs-6">
                        <a  class="fw-light nav-link fs-6"> <span class="fas fa-heart-broken me-1">
                    </button>
                    </span> {{ $item->liked()->count() }} </a>
                    </form>
                    @else
                    <form action="{{ route('like', $item) }}" method="post">
                        @csrf
                        @method('PUT')
                    <button type="submit" class="fw-light nav-link fs-6">
                        <a  class="fw-light nav-link fs-6"> <span class="fas fa-heart me-1">
                    </button>
                    </span> {{ $item->liked()->count() }} </a>
                    </form>
                    @endif
                    @endauth
                    @guest
                    <form action="{{ route('like', $item) }}" method="post">
                        @csrf
                        @method('PUT')
                    <button type="submit" class="fw-light nav-link fs-6">
                        <a  class="fw-light nav-link fs-6"> <span class="fas fa-heart me-1">
                    </button>
                    </span> {{ $item->liked()->count() }} </a>
                    </form>
                    @endguest

                </div>
                <div>
                    <span class="fs-6 fw-light text-muted"> <span class="fas fa-clock"> </span>
                        {{ $item->updated_at }} </span>
                </div>
            </div>
            @include('indexComponent.comment')
            @if ($showing ?? false)
            @else
                <hr>
                <div class="d-flex justify-content-center">
                    <form action="{{ route('content.show', $item) }}">
                        @csrf
                        <button type="submit" class="btn btn-light"> Xem thêm </button>
                    </form>

                </div>
            @endif



        </div>
    </div>
</div>
