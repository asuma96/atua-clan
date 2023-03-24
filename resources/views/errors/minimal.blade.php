<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="preload" href="{{mix('css/all.css')}}" as="style">
        <link rel="preload" href="{{mix('js/all.js')}}" as="script">
        <link rel="preload" href="{{mix('js/ads.js')}}" as="script">
        <link rel="icon" href="/img/favicon.ico" type="image/x-icon">
        <meta name="application-name" content="ATUA">
        <title>@yield('title')</title>

        @section('styles')
            <link rel="stylesheet" href="{{mix('css/all.css')}}">
        @show
    </head>
    <body class="antialiased">
    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        <div class="quiz-container mx-auto p-6 lg:p-8 quiz-content">
            <div>
                <a href="/" class="atua-img-error"><img src="/img/atua-logo-white.svg" class="svg-icon home-atua-logo error-atua"></a>
            </div>
            <div class="justify-center justify-center-error">
                <a href="/" class="error-atua-link">TAP HERE AND GO TO START PAGE!!!</a>
            </div>
        </div>
    </div>
    @section('scripts')
        <script
            src="https://code.jquery.com/jquery-3.6.4.min.js"
            integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8="
            crossorigin="anonymous"></script>
        <script src="{{mix('js/all.js')}}" type="application/javascript"></script>
        <script src="{{mix('js/ads.js')}}" type="application/javascript"></script>
    @show
    </body>
</html>
