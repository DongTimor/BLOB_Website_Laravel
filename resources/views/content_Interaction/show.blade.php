<!DOCTYPE html>
<html lang="EN">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Twitter Clone Bootstrap 5 Example</title>

    <link href="https://bootswatch.com/5/sketchy/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ mix('resources/css/app.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    {{-- <script>
        window.addEventListener('pageshow', function(event) {
            if (event.persisted) {
                location.reload(); // Tải lại trang nếu trang được tải từ cache
            }
        });
    </script> --}}
    <script>
        if (window.performance && window.performance.navigation.type === window.performance.navigation.TYPE_BACK_FORWARD) {

            window.location.replace("{{ route('content.index') }}"); // Chuyển hướng về trang chủ khi nhấn nút Back
        }
    </script>


@include('indexComponent.navbar')
    <div class="container py-4">
        <div class="row">
            <div class="col-3">
                {{-- left side bar --}}
                @include('indexComponent.leftSideBar')
            </div>
            <div class="col-6">
                @include('indexComponent.share.sucessMessage')
                @include('indexComponent.share.sharePost')
                <hr>

                {{-- Comment Content --}}

                    @include('indexComponent.content')







            </div>
            <div class="col-3">
                {{-- Search --}}
                @include('indexComponent.search')
                {{-- follow --}}
                @include('indexComponent.follow')
            </div>

        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>
