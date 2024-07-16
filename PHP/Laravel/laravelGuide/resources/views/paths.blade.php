@extends('templates.layout')

@section('title', 'Paths')

@section('pageName', 'Paths')

@section('selectedPathsTag', 'selected')

@section('pageContent')

<div class='guideDiv guideTxtDiv'>Laravel important <strong>paths</strong>:</div>
<div class='guideDiv guideContentDiv'>

    <li class='cmdLi suggestionLi'><i>- gestione management files</i></li>
    <li class='cmdLi'>/opt/lampp/htdocs/WWW/PROJECTS/Laravel/testProj/bootstrap/<strong>app.php</strong></li>
    
    <li class='cmdLi suggestionLi'><i>- gestione rotte</i></li>
    <li class='cmdLi'>/opt/lampp/htdocs/WWW/PROJECTS/Laravel/testProj/routes/<strong>web.php</strong></li>

    <li class='cmdLi suggestionLi'><i>- configurazione app</i></li>
    <li class='cmdLi'>/opt/lampp/htdocs/WWW/PROJECTS/Laravel/testProj/config/<strong>app.php</strong></li>

    <li class='cmdLi suggestionLi'><i>- configurazione DB</i></li>
    <li class='cmdLi'>/opt/lampp/htdocs/WWW/PROJECTS/Laravel/testProj/config/<strong>database.php</strong></li>

    <li class='cmdLi suggestionLi'><i>- configurazione DB</i></li>
    <li class='cmdLi'>/opt/lampp/htdocs/WWW/PROJECTS/Laravel/testProj/config/<strong>database.php</strong></li>

    <li class='cmdLi suggestionLi'><i>- variabili d'ambiente</i></li>
    <li class='cmdLi'>/opt/lampp/htdocs/WWW/PROJECTS/Laravel/testProj/<strong>.env</strong></li>

    <li class='cmdLi suggestionLi'><i>- gestione utenti sistema</i></li>
    <li class='cmdLi'>/opt/lampp/htdocs/WWW/PROJECTS/Laravel/testProj/app/Models/<strong>User.php</strong></li>

    <li class='cmdLi suggestionLi'><i>- classi sistema</i></li>
    <li class='cmdLi'>/opt/lampp/htdocs/WWW/PROJECTS/Laravel/testProj/app/Http/Controllers/<strong>Controller.php</strong></li>

    <li class='cmdLi suggestionLi'><i>- pagine gestione errori (dopo php artisan vendor:publish)</i></li>
    <li class='cmdLi'>/opt/lampp/htdocs/WWW/PROJECTS/Laravel/testProj/resources/views/<strong>errors</strong></li>

</div>

@endsection
