<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>E-library</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/app.css">
</head>

<body>

    <div id="app">  
        <v-app>
            <wk-snackbar></wk-snackbar>
            @yield('content')
        </v-app>
    </div>

    <script src="js/app.js"></script>
</body>
</body>

</html>
