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
    $dbTableUsers = new DBTableUsers;
    $helpers = new Helpers();


    // open page only for auth users
    if ($initSession -> getIsAuth() === false) {
        header('Location:/timeline/userNotAuthed.php');
    }


    // init variables
    $currentUserId = $initSession -> getUserId();
    $currentUser = $dbTableUsers -> getSingleUserById($currentUserId);


    // Page HTML
    $htmlMainLayout = $helpers -> includeHtml('mainLayout.php', [
        'pageTitle' => 'Mi perfil',
        'isUserAuth' => $initSession -> getIsAuth(),
        'currentUserName' => $initSession -> getUserName(),
        'categories' => $dbTableCategories -> getAllCategories(),
        'htmlMainContent' => $helpers -> includeHtml('myProfile.php', [
            'user' => $currentUser
        ])
    ]);

    print($htmlMainLayout);
