<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="shortcut icon" href="/images/cloud1.png" type='image/png' />
 
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap4/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('tether/css/tether.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/uploadfile.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dropzone.css') }}" rel="stylesheet">
    <link href="{{ asset('jquery-confirm/dist/jquery-confirm.min.css') }}" rel="stylesheet">
    <link href="{{ asset('datatables/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap-table/dist/bootstrap-table.min.css') }}" rel="stylesheet">
    <!-- Font-Awesome -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
    <!--JsTree 3.3.1 -->
    <link href="{{ asset('jstree/dist/themes/default/style.min.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script> window.Laravel = '{!! json_encode([ "csrfToken" => csrf_token(), ]) !!}'; </script>
</head>
<body>
    <div id="app" onunload="HandleClose()">
        @if(Auth::check())
            @include('layouts/menu')
        @endif

        @yield('content')
    </div>

    <!-- Scripts -->
    <!-- <script src="{{ asset('js/style.js') }}"></script> -->
    <script src="{{ asset('js/jquery-3.1.0.min.js')}}"></script>
    <script src="{{ asset('js/chat.js') }}"></script>
    <script src="{{ asset('js/jquery_play.js') }}"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.1/jquery.min.js"></script> -->
    <script src="{{ asset('tether/js/tether.min.js')}}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <!--<script src="{{ asset('bootstrap4/js/bootstrap.min.js')}}"></script>-->
    <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>-->
    <script src="{{ asset('js/jquery.uploadfile.min.js')}}"></script>
    <script src="{{ asset('js/dropzone.js') }}"></script>
    <script src="{{ asset('jstree/dist/jstree.min.js') }}"></script>
    <script src="{{ asset('jquery-confirm/dist/jquery-confirm.min.js') }}"></script>
    <!--<script src="{{ asset('datatables/datatables.min.js') }}"></script>-->
    <script src="{{ asset('bootstrap-table/dist/bootstrap-table.min.js')}}"></script>
    <script src="{{ asset('bootstrap-table/dist/locale/bootstrap-table-pt-BR.min.js')}}"></script>
    @yield('script')
</body>
</html>
