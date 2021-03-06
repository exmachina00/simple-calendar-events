<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div id="app" v-cloak>
        <div class="container-fluid pt-3">
            <div class="row justify-content-center">
                <div class="col-md-11">
                    <div class="card border-light">
                        <div class="card-header">
                            <strong>{{ __('content.calendar') }}</strong>
                        </div>

                        <div class="card-body">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div> <!-- End of row -->
        </div> <!-- End of container -->
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>