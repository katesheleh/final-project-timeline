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
    require_once('classes/FieldsValidation.php');
    require_once('classes/Helpers.php');


    // init classes
    $initSession = new InitSession();
    $dbTableCategories = new DBTableCategories();
    $dbTableUsers = new DBTableUsers();
    $fieldsValidation = new FieldsValidation();
    $helpers = new Helpers();


    // open page only for auth users
    if ($initSession -> getIsAuth() === false) {
        header('Location:/timeline/userNotAuthed.php');
    }


    // init variables
    $currentUserId = $initSession -> getUserId();
    $currentUser = $dbTableUsers -> getSingleUserById($currentUserId);


    // if form is submitted and there are no validation errors
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        // save form values in variables
        $name = trim($_POST['name']);
        $contacts = trim($_POST['contacts']);

        $dbTableUsers -> updateUserInfo($name, $contacts, $currentUserId);

        // redirect to login page
        header("Location:/timeline/myProfile.php");

    }


    // Page HTML
    $htmlMainLayout = $helpers -> includeHtml('mainLayout.php', [
        'pageTitle' => 'Regístrarte',
        'isUserAuth' => $initSession -> getIsAuth(),
        'currentUserName' => $initSession -> getUserName(),
        'categories' => $dbTableCategories -> getAllCategories(),
        'htmlMainContent' => $helpers -> includeHtml('editMyInfo.php', [
            'user' => $currentUser
        ])
    ]);

    print($htmlMainLayout);
