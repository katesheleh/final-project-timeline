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
    require_once('classes/FieldsValidation.php');
    require_once('classes/Helpers.php');


    // init classes
    $initSession = new InitSession();
    $dbTableCategories = new DBTableCategories();
    $dbTableLots = new DBTableProducts();
    $fieldsValidation = new FieldsValidation();
    $helpers = new Helpers();


    // open page only for auth users
    if ($initSession -> getIsAuth() === false) {
        header('Location:/timeline/userNotAuthed.php');
    }


    // init variables
    $currentUserId = $initSession -> getUserId();
    $currentLotId = $_GET['id'];
    $lot = $dbTableLots -> getSingleLot($currentLotId);
    $categories = $dbTableCategories -> getAllCategories();


    // avoid the user enter the lot id in the url and tries to delete the lot from another user
    // in this case it will be redirect to the page with the warning
    if($_SERVER['REQUEST_METHOD'] === 'GET' && ((int)$lot['author_id'] !== (int)$currentUserId)) {
        header("Location:/timeline/forbidden.php");
    }


    // if form is submitted and there are no validation errors
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $dbTableLots -> deleteLot($currentLotId);
        header("Location:/timeline/myLots.php");
    }


    // Page HTML
    $htmlMainLayout = $helpers -> includeHtml('mainLayout.php', [
        'pageTitle' => 'Eliminar producto',
        'isUserAuth' => $initSession -> getIsAuth(),
        'currentUserName' => $initSession -> getUserName(),
        'categories' => $categories,
        'htmlMainContent' => $helpers -> includeHtml('deleteLot.php', [
            'categories' => $categories,
            'lot' => $lot
        ])
    ]);

    print($htmlMainLayout);
