@auth

<h4> Share yours ideas </h4>
<form action="{{ route('content.store') }}" method="post" enctype="multipart/form-data" >
    @csrf
    @method("put")
                <div class="row">
                    <div class="mb-3">
                        <textarea name="content" class="form-control" id="idea" rows="3" id="content"></textarea>
                        @error('content')
                            <p class="text-danger d-block">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="d-flex flex-row" style="justify-content: space-between">
                        <input class="flex-1"  type="file" name="image" id="image">
                        <button class="btn btn-dark flex-1"> Share </button>
                    </div>

                </div>
</form>
@endauth
@guest
<h4> Login for share</h4>
@endguest
