<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Dantia-Task</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
      
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

          
    </head>
    <body class="">

    <div class="container-fluid">  
    <div class=" align-items-center  d-flex"> 
        <div class="col text-center pl-5">
            <img src="{{ asset('logos/logo1.jpg') }}" alt="dania Logo" class="img-fluid" style="max-height: 70px;">
        </div>
        <div class="col text-center">
            <h1>DAILY SAFETY INSPECTION CHECKLIST </h1>
        </div>
        <div class="col text-center">
            <img src="{{ asset('logos/logo2.jpg') }}" alt="Right Logo" class="img-fluid" style="max-height: 70px;">
        </div>
    </div>
</div>

   @yield('content')
   @include('layouts.footer')

   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
 
   @yield('ajax-scripts')
</body>
</html>
