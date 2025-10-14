    -   php artisan make:controller PagesController

    -   mkdir resources/views/pages

    -   touch resources/views/pages/about.blade.php

    -   in /Laravel/rubrica/app/Http/Controllers/PagesController.php:

<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;

    class PagesController extends Controller
    {
        public function about() {
            return view('pages.about');
        }
    }

    -   mappatura nuove rotte non predefinite:

    -   touch routes/pages.php

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;

Route::get('about/', [PagesController::class, 'about']);


    -   in /Laravel/rubrica/bootstrap/app.php, all'interno di "->withRouting(" :

then: function(){
    Route::prefix('pages')->group(
        base_path('routes/pages.php')
    );
}

    -   php artisan serve