<?php
    $app = app();
    $bindings = $app->getBindings();
    $logger = app('log');

    $laravelVersion = $app->version();
    $environment = $app->environment();
    $siteEnv = $app->isLocal() ? "Sviluppo" : "Produzione";
    $locale = $app->getLocale();

    $menuNavItems = [
        "Home"=> "/"
        ,"About" => "pages/about"
    ];
    $menuNavItems = array_reverse($menuNavItems);