<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="{{asset('css/app.css')}}" rel="stylesheet">
        <!-- Styles -->
      
    </head>
    <body class="antialiased">
       <div class="containe-fluid p-0">
            <div class="row no-gutters">
                <div class="col-sm-12" id="root">

                </div>
            </div>
       </div> 
    </body>
    <script src="{{asset('js/app.js')}}"></script>
</html>
