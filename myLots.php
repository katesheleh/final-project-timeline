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
    require_once('classes/Helpers.php');


    // init classes
    $initSession = new InitSession();
    $dbTableCategories = new DBTableCategories();
    $dbTableLots = new DBTableProducts();
    $helpers = new Helpers();

    // open page only for auth users
    if ($initSession -> getIsAuth() === false) {
        header('Location:/timeline/userNotAuthed.php');
    }


    // init variables
    $currentUserId = $initSession -> getUserId();
    $lotsTotal = $dbTableLots -> countAllLotsForSingleUser($currentUserId);
    // pagination
    $lotsPerPage = 6;
    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
    $pagesTotal = ceil($lotsTotal / $lotsPerPage);
    $offset = ($currentPage - 1) * $lotsPerPage;
    $pages = range(1, $pagesTotal);
    $lotsForSingleUser = $dbTableLots -> getAllLotsForSingleUser($currentUserId, $lotsPerPage, $offset);



    // Page HTML
    $htmlMainLayout = $helpers -> includeHtml('mainLayout.php', [
        'pageTitle' => 'Mis productos',
        'isUserAuth' => $initSession -> getIsAuth(),
        'currentUserName' => $initSession -> getUserName(),
        'categories' => $dbTableCategories -> getAllCategories(),
        'htmlMainContent' => $helpers -> includeHtml('myLots.php', [
            'lots' => $lotsForSingleUser,
            'currentPage' => $currentPage,
            'pages' => $pages,
            'pagesTotal' => $pagesTotal,
            'helpers' => $helpers
        ])
    ]);

    print($htmlMainLayout);
