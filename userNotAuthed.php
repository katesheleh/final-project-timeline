<?php

    // init session
    if(!isset($_SESSION)){
        session_start();
    }

    // include files
    require_once('classes/ConnectToDB.php');
    require_once('classes/DBTableUsers.php');
    require_once('classes/InitSession.php');
    require_once('classes/DBTableCategories.php');
    require_once('classes/Helpers.php');


    // init classes
    $initSession = new InitSession();
    $dbTableCategories = new DBTableCategories();
    $helpers = new Helpers();


    // init variables
    $categories = $dbTableCategories -> getAllCategories();


    // Page HTML
    $htmlMainLayout = $helpers -> includeHtml('mainLayout.php', [
        'pageTitle' => 'El usuario no está autentificado',
        'isUserAuth' => $initSession -> getIsAuth(),
        'currentUserName' => $initSession -> getUserName(),
        'categories' => $categories,
        'htmlMainContent' => $helpers -> includeHtml('userNotAuthed.php', [])
    ]);

    print($htmlMainLayout);
