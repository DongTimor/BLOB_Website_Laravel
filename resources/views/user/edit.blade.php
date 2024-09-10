<div class="card">
    <div class="px-3 pt-4 pb-2">
        <form enctype="multipart/form-data" method="POST" action="{{ route('user.update', $user) }}">
            @csrf
            @method("put")
            <div class="d-flex align-items-center justify-content-between">

                <div class="d-flex align-items-center">
                    <img " class="avatar1"
                        src="{{ $user->getAvatarImage() }}"
                        alt="{{ $user->name }}">
                    <div>
                        {{-- <h3 class="card-title mb-0"><a href="#"> {{ $user->name }} --}}
                        <input class='' name="name" id="name" value="{{ $user->name }}"
                            type="text"></input>
                        @error('name')
                            <span class='text-danger fs-6 mt-2'>{{ $message }}</span>
                        @enderror
                        </a></h3>
                        <span class="text-muted">@</span>
                        <span class="fs-6 text-muted">{{ $user->name }}</span>
                    </div>
                </div>

            </div>
            <label class="mt-3" for="">Add a image</label>
            <input type="file" class="form-control" name="image">

            <div class="px-2 mt-4">
                <h5 class="fs-5"> Bio : </h5>
                <textarea name="bio" class="form-control" id="bio" rows="3" text="">{{ $user->bio }}</textarea>


                <div class="d-flex justify-content-start">
                    <a href="#" class="fw-light nav-link fs-6 me-3"> <span class="fas fa-user me-1">
                        </span> 120 Followers </a>
                    <a href="#" class="fw-light nav-link fs-6 me-3"> <span class="fas fa-brain me-1">
                        </span> {{ $user->content()->count() }} </a>
                    <a href="#" class="fw-light nav-link fs-6"> <span class="fas fa-comment me-1">
                        </span> {{ $user->comment()->count() }} </a>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary btn-sm"> Apply </button>
                </div>


            </div>
        </form>
    </div>
</div>
<hr>
<div class="mb-5"></div>
@foreach ($user->content() as $item)
    @include('indexComponent.content')
@endforeach
{{ $user->content()->links() }}
