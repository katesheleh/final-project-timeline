<?php

    // init session
    if(!isset($_SESSION)){
        session_start();
    }


    // setup default timezone
    date_default_timezone_set('Europe/Madrid');


    // include files
    require_once('classes/ConnectToDB.php');
    require_once('classes/DBTableUsers.php');
    require_once('classes/InitSession.php');
    require_once('classes/DBTableCategories.php');
    require_once('classes/DBTableProducts.php');
    require_once('classes/DBTableBets.php');
    require_once('classes/LotWinner.php');
    require_once('classes/Helpers.php');


    // init classes
    $initSession = new InitSession();
    $dbTableUsers = new DBTableUsers;
    $dbTableCategories = new DBTableCategories();
    $dbTableRates = new DBTableBets();
    $lotWinner = new LotWinner();
    $helpers = new Helpers();


    // open page only for auth users
    if ($initSession -> getIsAuth() === false) {
        header('Location:/timeline/userNotAuthed.php');
    }

    $now = date_create('now') -> format('Y-m-d H:i:s');

    if ($initSession -> getIsAuth() === true) {
        $lotWinner -> getLotsWinners($now);
    }

    // Page HTML
    $htmlMainLayout = $helpers -> includeHtml('mainLayout.php', [
        'pageTitle' => 'Mis pujas',
        'isUserAuth' => $initSession -> getIsAuth(),
        'currentUserName' => $initSession -> getUserName(),
        'categories' => $dbTableCategories -> getAllCategories(),
        'htmlMainContent' => $helpers -> includeHtml('myRates.php', [
            'myRates' => $dbTableRates -> getAllRatesOfSingleUser($initSession -> getUserId()),
            'helpers' => $helpers,
            'dbTableUsers' => $dbTableUsers
        ])
    ]);

    print($htmlMainLayout);
