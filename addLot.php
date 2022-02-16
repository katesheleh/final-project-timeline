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
    $categories = $dbTableCategories -> getAllCategories();
    $formValidationErrors = [];


    // check form validation Errors
    foreach ($_POST as $key => $value) {
        $validationRules = [
            'lotName' => $fieldsValidation -> verifyTextField($_POST['lotName'], 3, 105, 'Introduce nombre del producto'),
            'lotCategory' => $fieldsValidation -> verifyNotEmptyField($_POST['lotCategory'], 'El campo no puede estar vacío'),
            'lotDesc' => $fieldsValidation -> verifyTextField($_POST['lotDesc'], 5, 55000, 'Escribe la descripción del producto'),
            'lotExpirationDate' => $fieldsValidation -> verifyIntroducedDate($_POST['lotExpirationDate']),
            'lotInitPrice' => $fieldsValidation -> verifyPositiveNumber($_POST['lotInitPrice'], 'Introduce el precio inicial'),
            'lotRateStep' => $fieldsValidation -> verifyPositiveNumber($_POST['lotRateStep'], 'Introduce el valor minimo para una puja')
        ];

        if (isset($validationRules[$key])) {
            $rule = $validationRules[$key];
            $formValidationErrors[$key] = $rule;
        }
    }


     // validate image
     if (isset($_FILES['lotImage'])) {
        $error = $fieldsValidation -> verifyUploadedImage('lotImage');

        if (null === $error) {
            // $filePath = __DIR__ . '/uploads/';
            move_uploaded_file($_FILES['lotImage']['tmp_name'], __DIR__ . '/uploads/' . $_FILES['lotImage']['name']);
        } else {
            $formValidationErrors['lotImage'] = $error;
        }
    }


    // clean array from NULL values
    $formValidationErrors = array_filter($formValidationErrors);


    // if form is submitted and there are no validation errors
    if($_SERVER['REQUEST_METHOD'] === 'POST' && count($formValidationErrors) === 0) {
        // save form values in variables
        $lotName = trim($_POST['lotName']);
        $lotCategoryId = $_POST['lotCategory'];
        $lotDesc = trim($_POST['lotDesc']);
        $lotInitPrice = $_POST['lotInitPrice'];
        $lotRateStep = $_POST['lotRateStep'];
        $imageUrl = $_FILES['lotImage']['name'];
        $lotExpirationDate = $_POST['lotExpirationDate'];
        $authorId = $initSession -> getUserId();
        $now = date_create('now') -> format('Y-m-d H:i:s');

        // add a new lot to database
        $dbTableLots -> insertNewSingleLot($now, $lotName, $lotDesc, $lotRateStep, $lotInitPrice, $imageUrl, $lotExpirationDate, $lotCategoryId, $authorId);

        // get last lot id
        $lastLotId = $dbTableLots -> getLastCreatedLotId();

        // redirect to a lot page
        header("Location:/timeline/lot.php?&id=$lastLotId");
    }


    // Page HTML
    $htmlMainLayout = $helpers -> includeHtml('mainLayout.php', [
        'pageTitle' => 'Añadir producto',
        'isUserAuth' => $initSession -> getIsAuth(),
        'currentUserName' => $initSession -> getUserName(),
        'categories' => $categories,
        'htmlMainContent' => $helpers -> includeHtml('addLot.php', [
            'categories' => $categories,
            'formValidationErrors' => $formValidationErrors,
            'fieldsValidation' => $fieldsValidation
        ])
    ]);

    print($htmlMainLayout);
