<!doctype html>
<html lang="ja">

<head>
    <meta charset="UTF-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Interigent</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ mix('js/app.js') }}" defer></script>

</head>

<body>
    <div id="app">
        <router-view />
    </div>
</body>

</html>



