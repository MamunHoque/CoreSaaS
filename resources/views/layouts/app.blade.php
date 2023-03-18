<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="img/icons/icon-48x48.png"/>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

   <!-- Scripts -->
    @vite(['resources/css/app.css','resources/js/app.js'])
    <link as="style" src="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />
    <link as="style" src="https://cdn.datatables.net/buttons/2.3.6/css/buttons.bootstrap5.min.css" />

</head>

<body>
<div class="wrapper">

    @include('layouts.sidebar')

    <div class="main">

        @include('layouts.navigation')

        <main class="content">
            <div class="container-fluid p-0">
                @include('layouts.breadcrumb', [
                   'title'  => $title ?? "",
                   'create_new'  => $create_new ?? ""
                ])
                @yield('content')

            </div>
        </main>

        @include('layouts.footer')

    </div>
</div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script> <!-- MAKE SURE THIS IS LOADED -->

<link
    rel="stylesheet"
    type="text/css"
    href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

<script
    type="text/javascript"
    charset="utf8"
    src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js">
</script>

<script
    type="text/javascript"
    charset="utf8"
    src="{{asset('js/script-datatable.js')}}">
</script>

</html>
