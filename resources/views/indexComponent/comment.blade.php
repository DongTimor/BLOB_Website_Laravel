<div>
    <form action="{{ route('comment.store', $item) }}" method="post">
        @csrf
        <div class="mb-3">
            <textarea name="comment" id="comment" class="fs-6 form-control" rows="1"></textarea>
        </div>
        @error("comment")
        <span class="text-danger">{{ $message }}</span>

        @enderror
        <div>
            <button type="submit" btn btn-primary btn-sm"> Post Comment </button>
        </div>
    </form>
    <hr>

    @if ($showing ?? false)
    @foreach ($comment_show as $comment)
    <div class="d-flex align-items-start">
        <img style="width:35px; height:35px" class="avatar1"
            src="{{ $comment->user->getAvatarImage() }}" alt="Luigi Avatar">
        <div class="w-100">
            <div class="d-flex justify-content-between">
                <h6 class="">{{ $comment->user->name }}
                </h6>
                <small class="fs-6 fw-light text-muted"> 3 hour
                    ago</small>
            </div>
            <p class="fs-6 mt-3 fw-light">
                {{ $comment->comment}}
            </p>
        </div>
    </div>
    @endforeach
    {{ $comment_show -> links() }}
    @else
    @php
    $comments = $item->comments()->paginate(2); // Paginate 10 comments per page
    @endphp
    @foreach ($comments as $comment)
    <div class="d-flex align-items-start">
        <img style="width:35px; height:35px" class="avatar1"
            src="{{ $comment->user->getAvatarImage() }}" alt="Luigi Avatar">
        <div class="w-100">
            <div class="d-flex justify-content-between">
                <h6 class="">{{ $comment->user->name }}
                </h6>
                <small class="fs-6 fw-light text-muted"> 3 hour
                    ago</small>
            </div>
            <p class="fs-6 mt-3 fw-light">
                {{ $comment->comment}}
            </p>
        </div>
    </div>
    @endforeach

    @endif




</div>
