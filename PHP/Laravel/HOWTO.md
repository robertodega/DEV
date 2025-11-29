-   composer create-project laravel/laravel <PROJ_NAME>

-   in /Laravel/<PROJ_NAME>/.env

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=<PROJ_NAME>
DB_USERNAME=root
DB_PASSWORD=

    -   cd <PROJ_NAME>
    -   php artisan migrate

    -   php artisan make:controller <PROJ_NAME>Controller

    -   in /Laravel/<PROJ_NAME>/routes/web.php:

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\<PROJ_NAME>Controller;

Route::get('/', [<PROJ_NAME>Controller::class, 'index']);

    -   mkdir public/css public/js public/include

    -   touch public/css/custom.css public/js/custom.js public/include/menunav.php

    -   touch resources/views/home.blade.php

<?php
    $cur = 'home';
?>
<!DOCTYPE html>
<html>
    <head>
        <title><PROJ_NAME> Laravel</title>
        <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    </head>
    <body>
        <?php include '../public/include/menunav.php'; ?>
        <h1>Benvenuto nella <PROJ_NAME> Laravel!</h1>
    </body>
</html>

<script src="{{ asset('js/custom.js') }}"></script>


    -   in /Laravel/<PROJ_NAME>/app/Http/Controllers/<PROJ_NAME>Controller.php:

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class <PROJ_NAME>Controller extends Controller
{
    public function index()
    {
        return view('home');
    }
}

    -   php artisan serve