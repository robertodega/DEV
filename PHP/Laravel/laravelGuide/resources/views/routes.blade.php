@extends('templates.layout')

@section('title', 'Routes')

@section('pageName', 'Routes')

@section('selectedRoutesTag', 'selected')

@section('pageContent')

<div class='guideDiv guideTxtDiv'>lista delle rotte predefinite:</div>
<div class='guideDiv guideContentDiv'>php artisan route:list </div>

<div class='guideDiv guideTxtDiv'>Gestione delle rotte</div>
<div class='guideDiv guideContentDiv'>
    <p class='liTitle'>Rotta come path</p><hr />
    <code class='respCode'>
        <pre>
Route::<strong>get</strong>('/users/{name?}/{lastname?}/{age?}', 
#       <strong>static function</strong>(string $name, string $lastname, int $age) {                     #   parametri obbligatori
<strong>static function</strong>(?string $name = '', ?string $lastname = '', ?int $age = 0) {            #   parametri opzionali
echo "Hello User $name $lastname, you are $age years old";
}
)
->where(                                                                                        #   check parametri passati
[
'age' => '[0-9]{2,3}',          #   check con regular expression su valore numerico età con minimo 2 massimo 3 cifre numeriche
'name' => '[a-zA-Z]{3,}',       #   check con regular expression su valore stringa name con minimo 3 caratteri
'lastname' => '[a-zA-Z]{2,}',   #   check con regular expression su valore stringa lastname con minimo 2 caratteri
]
)
        </pre>
    </code>
    
    <p class='liTitle'>Rotta su vista</p><hr />
    <code class='respCode'>
        <pre>
Route::<strong>view</strong>('user-details', 'userDetail', [     #   rotta su vista custom (parametro url => destination file in /resources/views)
'name' => 'Nome',
'lastname' => 'Cognome',
]);
        </pre>
    </code>
    
    <p class='liTitle'>Route redirect</p><hr />
    <code class='respCode'>
        <pre>
Route::get('/dettaglioUtente', function () {
return <strong>redirect</strong>('users/Nome/Cognome/47');
});
        </pre>
    </code>

</div>

<div class='guideDiv guideTxtDiv'>Gestione tramite <strong>Controller</strong></div>
<div class='guideDiv guideContentDiv'>
    <li class='cmdLi suggestionLi'><i>- Help menu</i></li>
    <li class='cmdLi'>php artisan make:controller --help </li>

    <li class='cmdLi suggestionLi'><i>- Creazione controller di tipo resource che usa il model di default User</i></li>
    <li class='cmdLi'>php artisan make:controller UsersController --resource -m User</li>

    <li class='cmdLi suggestionLi'><i>- inclusione controller</i></li>
    <li class='cmdLi'>use App\Http\Controllers\UsersController;</li>

</div>

<div class='guideDiv guideTxtDiv'>Route::resource</div>
<div class='guideDiv guideContentDiv'>

    <li class='cmdLi suggestionLi'><i>- gestione rotta users tramite controller UsersController</i></li>
    <li class='cmdLi'>Route::resource('users', UsersController::class);</li>

    <li class='cmdLi suggestionLi'><i>- edit public function index() del controller</i></li>
</div>

@endsection

