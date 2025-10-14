    -   composer create-project laravel/laravel rubrica

    -   in /Laravel/rubrica/.env

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rubrica
DB_USERNAME=root
DB_PASSWORD=

    -   cd rubrica
    -   php artisan migrate

    -   php artisan make:controller RubricaController

    -   in /Laravel/rubrica/routes/web.php:

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RubricaController;

Route::get('/', [RubricaController::class, 'index']);

    -   mkdir public/css public/js public/include

    -   touch public/css/custom.css public/js/custom.js public/include/menunav.php

    -   touch resources/views/home.blade.php

<?php
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


    -   in /Laravel/rubrica/app/Http/Controllers/RubricaController.php:

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RubricaController extends Controller
{
    public function index()
    {
        return view('home');
    }
}

    -   php artisan serve