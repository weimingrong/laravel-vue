<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>laravel admin</title>
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body style="margin: 0;padding: 0;">
    <div id="app">

    </div>

<script src="/js/manifest.js"></script>
<script src="/js/vendor.js"></script>
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
