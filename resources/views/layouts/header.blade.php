<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="/css/bootstrap-5.0.2-dist/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/fontawesome-free-6.5.2-web/fontawesome-free-6.5.2-web/css/all.min.css">
    <link rel="shortcut icon" href="image/icons8-facebook-messenger.png" type="image/x-icon">
    <?php 
       echo $style; 
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{"- ".$titre}}</title>
</head>
<body>
    @yield('contenu') 
<script src="js/js/bootstrap.min.js"> </script>
</body>
</html>