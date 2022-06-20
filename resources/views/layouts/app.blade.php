<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet"><!-- Fonts -->
        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    </head>
    <body class="antialiased">
       <main>
           <div class="content-holder">
               @include('modules.sidebar')
                <div class="main-content">
                    @include('modules.logout')

                    @yield('content')
                </div>
           </div>
       </main>
       <script src="https://kit.fontawesome.com/fc187a78ad.js" crossorigin="anonymous"></script>
       <script src="{{ asset('/js/app.js') }}"></script>
    </body>
</html>
