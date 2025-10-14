<?php
    include '../public/include/const.php';
    $cur = 'home';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Rubrica Laravel</title>
        <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    </head>
    <body>
        <?php include '../public/include/menunav.php'; ?>
        <h1>Benvenuto nella Rubrica Laravel!</h1>
    </body>
</html>

<script src="{{ asset('js/custom.js') }}"></script>