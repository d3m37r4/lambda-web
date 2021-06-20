<!doctype html>
<!--suppress ALL -->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @hasSection('title')
            @yield('title') |
        @endif
        {{ config('app.name', 'Laravel') }}
    </title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
          integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
    <!-- MDB -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.8.0/mdb.min.css"
          integrity="sha512-IOy/HxeKfBflRjSsh+pYnEtfnV1lDN6HmazKjAOPlTfLHMoIAGPAvIo/7dH9sXu2kE0QV91HtAMVaLloM0aeCA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/custom.style.css') }}">
</head>
<body class="d-flex flex-column min-vh-100" style="background-color: hsl(0, 0%, 95%);">
    <!-- Navbar content -->
    @include('components.navbar')

    <!-- Main content -->
    <main class="flex-shrink-0">
        <div class="container-xxl">
            @yield('content')
        </div>
    </main>

    <!-- Footer content -->
    @include('components.footer')

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.8.0/mdb.min.js"
            integrity="sha512-rVJOxE3yHzlhHmJPnqcl5SZKZ49Foi1AOS3DUD1xw8HsniDi0Ih58kVMAY4mHXVam+4SVXhzqfikJl9/dlm54g=="
            crossorigin="anonymous" referrerpolicy="no-referrer">
    </script>
    <script src="{{ asset('js/secure-random-password.min.js') }}"></script>
    <script src="{{ asset('js/custom.scripts.js') }}"></script>
    @stack('secondary-scripts')
</body>
</html>
