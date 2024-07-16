<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>@yield('title','Home page')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <link rel='stylesheet' href='/css/custom.css' />

  </head>
  <body>

  <body>
        <header class='headerDiv'>Laravel Guide</header>
        <div class='containerDiv'>
            <div class='containerSubDiv containerLeftDiv'>
            <div class='listItemContainer'><li class='guideItem'><a href='/'>Home</a></li></div>
                <div class='listItemContainer'><li class='guideItem @yield("selectedDependenciesTag")'><a href='dependencies'>Dependencies</a></li></div>
                <div class='listItemContainer'><li class='guideItem @yield("selectedProjectTag")'><a href='project'>Project creation</a></li></div>
                <div class='listItemContainer'><li class='guideItem @yield("selectedControllerTag")'><a href='controller'>Controller</a></li></div>
                <div class='listItemContainer'><li class='guideItem @yield("selectedViewsTag")'><a href='views'>Views</a></li></div>
                <div class='listItemContainer'><li class='guideItem @yield("selectedBladeTag")'><a href='bladeTemplates'>Blade Templates</a></li></div>
                <div class='listItemContainer'><li class='guideItem @yield("selectedPathsTag")'><a href='paths'>Paths</a></li></div>
                <div class='listItemContainer'><li class='guideItem @yield("selectedRoutesTag")'><a href='routes'>Routes</a></li></div>
            </div>

            <div class='containerSubDiv containerRightDiv'>

                <div class='containerTitle containerSubDivTitle'><a href='/'>Laravel Guide</a></div>
                <div class='containerTitle containerSubDivSubTitle'>@yield('pageName')</div>
                <div class='clearDiv'></div>

                <div class='containerSubDivContent'>@yield('pageContent')</div>

            </div>
            <div class='clearDiv'></div>
        </div>
        <footer class="footerDiv">
            Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
        </footer>
    </body>

  </body>
</html>