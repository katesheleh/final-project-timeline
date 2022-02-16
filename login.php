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
    $fieldsValidation = new FieldsValidation();
    $helpers = new Helpers();


    // init variables
    $categories = $dbTableCategories -> getAllCategories();
    $formValidationErrors = [];


    // check form validation Errors
    foreach ($_POST as $key => $value) {
        $validationRules = [
            'userEmail' => $fieldsValidation -> verifyExistingEmail($_POST['userEmail']),
            'userPassword' => $fieldsValidation -> verifyExistingPassword($_POST['userPassword'], $_POST['userEmail']),
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
        $email = trim($_POST['userEmail']);

        // create session var
        $_SESSION['userEmail'] = $email;

        // redirect to index.php
        header("Location:/timeline/index.php");

    }


    // Page HTML
    $htmlMainLayout = $helpers -> includeHtml('mainLayout.php', [
        'pageTitle' => 'Login',
        'isUserAuth' => $initSession -> getIsAuth(),
        'currentUserName' => $initSession -> getUserName(),
        'categories' => $categories,
        'htmlMainContent' => $helpers -> includeHtml('login.php', [
            'formValidationErrors' => $formValidationErrors,
            'fieldsValidation' => $fieldsValidation
        ])
    ]);

    print($htmlMainLayout);
