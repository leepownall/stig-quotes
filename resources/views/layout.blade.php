<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#343a40">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <title>Stig Quotes</title>
  </head>
  <body class="bg-light">
    @include('navigation')
    @yield('content')
    <script src="{{ mix('js/app.js') }}"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('services.analytics.tracking_id') }}"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', '{{ config('services.analytics.tracking_id') }}');
    </script>
  </body>
</html>
