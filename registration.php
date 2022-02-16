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


    // open page only for not authed users
    if ($initSession -> getIsAuth() === true) {
        header('Location:/timeline/userAuthed.php');
    }


    // init variables
    $formValidationErrors = [];


    // check form validation Errors
    foreach ($_POST as $key => $value) {
        $validationRules = [
            'email' => $fieldsValidation -> verifyNewEmail($_POST['email']),
            'password' => $fieldsValidation -> verifyTextField($_POST['password'], 5, 15, 'Introduce la contraseña'),
            'name' => $fieldsValidation -> verifyTextField($_POST['name'], 5, 25, 'Introduce el nombre'),
            'contacts' => $fieldsValidation -> verifyTextField($_POST['contacts'], 10, 100, 'Escribe cómo contactar contigo'),
        ];

        if (isset($validationRules[$key])) {
            $rule = $validationRules[$key];
            $formValidationErrors[$key] = $rule;
        }
    }


    // clean array from NULL values
    $formValidationErrors = array_filter($formValidationErrors);


    // if form is submitted and there are no validation errors
    if($_SERVER['REQUEST_METHOD'] === 'POST' && count($formValidationErrors) === 0) {
        // save form values in variables
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $name = trim($_POST['name']);
        $contacts = trim($_POST['contacts']);
        $now = date_create('now') -> format('Y-m-d H:i:s');

        $dbTableUsers -> insertNewUser($now, $email, $password, $name, $contacts);

        // redirect to login page
        header("Location:/timeline/login.php");

    }


    // Page HTML
    $htmlMainLayout = $helpers -> includeHtml('mainLayout.php', [
        'pageTitle' => 'Regístrarte',
        'isUserAuth' => $initSession -> getIsAuth(),
        'currentUserName' => $initSession -> getUserName(),
        'categories' => $dbTableCategories -> getAllCategories(),
        'htmlMainContent' => $helpers -> includeHtml('registration.php', [
            'formValidationErrors' => $formValidationErrors,
            'fieldsValidation' => $fieldsValidation
        ])
    ]);

    print($htmlMainLayout);
