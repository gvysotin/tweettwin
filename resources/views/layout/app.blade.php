<!DOCTYPE html>
<html lang="EN">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> @yield('title') | {{ config('app.name') }} </title>

{{--    <link href="https://bootswatch.com/5/sketchy/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">--}}
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" crossorigin="anonymous">

    {{-- <link href="https://bootswatch.com/5/zephyr/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous"> --}}



{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"--}}
{{--        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="--}}
{{--        crossorigin="anonymous" referrerpolicy="no-referrer" />--}}


    <link rel="stylesheet" href="{{asset('css/font-awesome.all.min.css')}}"
          integrity="sha512-0S/X50C6qAKCcNeFPoXySDOuXkXNFtBc1xL/wAwBg5Ex5j3rV6rsDs+FEHuDXxqIR/AnoeApqPDjwx6jblLClg=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>

<body>
    @include('layout.nav')
    <div class="container py-4">

        {{-- Page content goes here --}}
        @yield('content')

    </div>
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>

{{--        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"--}}
{{--        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">--}}
{{--    </script>--}}
</body>

</html>
