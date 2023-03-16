<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="application-name" content="ATUA">
{{--
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon/favicon-32x32.png">
--}}
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    @stack('meta-seo-settings-brand')
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image"
          content="@yield('og_image', asset('/img/snippet.png'))">
    <meta property="og:image:url"
          content="@yield('og_image', asset('/img/snippet.png'))"/>
    <meta property="og:site_name" content="ATUA-Clan.com">
    {{--<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>--}}
    <script defer src="https://af.click.ru/af.js?id=10411"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="preload" href="{{mix('css/all.css')}}" as="style">
    <link rel="preload" href="{{mix('js/all.js')}}" as="script">
    <link rel="preload" href="{{mix('js/ads.js')}}" as="script">
    @section('styles')
        <link rel="stylesheet" href="{{mix('css/all.css')}}">
    @show
    @section('header')
    @show
</head>
<body>
<main id="main">
    <div class="container">
        @yield('content')
    </div>
</main>11
@section('scripts')
    <script src="{{mix('js/all.js')}}" type="application/javascript"></script>
    <script src="{{mix('js/ads.js')}}" type="application/javascript"></script>
@show
</body>
</html>
