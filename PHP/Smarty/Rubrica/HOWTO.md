- cd /opt/lampp/htdocs/WWW/PROJECTS/PHP/Smarty
- mkdir rubricaSmarty
- cd rubricaSmarty

- mkdir templates templates_c css js img config classes include DB
- chmod 777 templates_c
- touch index.php templates/home.tpl CSS/custom.css JS/custom.js classes/dbman.php classes/manager.php include/classConn.php

- cp -r ../smarty-4.5.5/libs/ .
- nano templates/home.tpl

        <!DOCTYPE html>
        <html lang="it">
        <head>
            <title>Rubrica Smarty</title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

            <link rel="icon" type="image/x-icon" href="{$imgPath}favicon.ico" />
            <link rel="stylesheet" href="{$cssPath}custom.css">
        </head>

        <body>
            <div class="headerDiv"><a href='{$rootPath}'>{$appTitle}</a></div>
            <div class="boxDiv" id="searchDiv">
                
                <form id="searchForm" method="post" action="./">
                    <input type="hidden" name="action" value="search">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="searchText" placeholder="Search for a contact..." aria-label="Search for a contact...">
                        <button class="btn btn-outline-secondary" type="submit">Search</button>
                    </div>
                </form>
                <div class="text-center">
                    <a href="./?action=add" class="btn btn-primary">Add a contact</a>
                    <a href="./?action=showAll" class="btn btn-primary">Show all contacts</a>
                </div>

                <div class="boxDiv" id="resultsDiv">
                    {$resultTable}
                </div>

            </div>
        </body>

        </html>

        <script src="{$jsPath}custom.js"></script>



- nano index.php

        <?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        require_once __DIR__ . '/libs/Smarty.class.php';

        include_once __DIR__ . '/config/config.php';
        include_once __DIR__ . '/include/classConn.php';
        include_once __DIR__ . '/include/dataTable.php';

        $smarty = new Smarty();
        $smarty->setTemplateDir(__DIR__ . '/templates/');
        $smarty->setCompileDir(__DIR__ . '/templates_c/');

        $smarty->assign('rootPath', ROOT_PATH);
        $smarty->assign('cssPath', CSS_PATH);
        $smarty->assign('jsPath', JS_PATH);
        $smarty->assign('imgPath', IMG_PATH);
        $smarty->assign('appTitle', APP_TITLE);
        $smarty->assign('resultTable', $resultTable);

        $smarty->display('home.tpl');
        ?>

- sudo /opt/lampp/lampp start
- Browse http://localhost/rubricaSmarty/index.php



