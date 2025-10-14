<?php
    include '../public/include/const.php';
    $cur = 'search';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Rubrica Laravel</title>
        <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    </head>
        <?php include '../public/include/menunav.php'; ?>
        <h1><a href='/'>Rubrica Laravel</a> / About</h1>
        <br />
            <li>Versione di Laravel: <strong><?=$laravelVersion?></strong></li>
            <li>Environment: <strong><?=$environment?></strong></li>
            <li>Ambiente: <strong><?=$siteEnv?></strong></li>
            <li>Localizzazione attuale: <strong><?=$locale?></strong></li>
            <li>bindings: <strong><?php echo count($bindings); ?></strong></li>
        </h3>
    </body>
</html>

<script src="{{ asset('js/custom.js') }}"></script>