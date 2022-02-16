<?php

    // init session
    if(!isset($_SESSION)){
        session_start();
    }


    // setup default timezone
    date_default_timezone_set('Europe/Madrid');


    // include files
    require_once('classes/DBTableUsers.php');
    require_once('classes/InitSession.php');
    require_once('classes/ConnectToDB.php');
    require_once('classes/DBTableCategories.php');
    require_once('classes/DBTableProducts.php');
    require_once('classes/Helpers.php');


    // init classes
    $initSession = new InitSession();
    $dbTableCategories = new DBTableCategories();
    $dbTableLots = new DBTableProducts();
    $helpers = new Helpers();


    // init variables
    $categories = $dbTableCategories -> getAllCategories();
    $now = date_create('now') -> format('Y-m-d H:i:s');
    $activeLots = $dbTableLots -> getActiveLots(9, $now);


    // Page HTML
    $htmlMainLayout = $helpers -> includeHtml('mainLayout.php', [
        'pageTitle' => 'Timeline',
        'isUserAuth' => $initSession -> getIsAuth(),
        'currentUserName' => $initSession -> getUserName(),
        'categories' => $categories,
        'htmlMainContent' => $helpers -> includeHtml('index.php', [
            'categories' => $categories,
            'lots' => $activeLots,
            'helpers' => $helpers
        ])
    ]);

    print($htmlMainLayout);
