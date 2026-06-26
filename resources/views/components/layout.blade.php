<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    @env('development')
        <script type="module" src="http://localhost:5173/@vite/client"></script>
        <script type="module" src="http://localhost:5173/resources/js/app.ts"></script>
        <link rel="stylesheet" href="http://localhost:5173/resources/css/app.css">
    @endenv
</head>

<body>{{ $slot }} </body>

</html>
