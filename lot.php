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
    require_once('classes/FieldsValidation.php');
    require_once('classes/Helpers.php');


    // check lot id
    $lotId = $_GET['id'];


    // show 404 page if id is empty
    if (!isset($lotId)) {
        header('Location:/timeline/404.php');
    }


    // init classes
    $initSession = new InitSession();
    $dbTableCategories = new DBTableCategories();
    $dbTableRates = new DBTableBets();
    $dbTableLots = new DBTableProducts();
    $lotWinner = new LotWinner();
    $fieldsValidation = new FieldsValidation();
    $helpers = new Helpers();


    // init lot info
    $lot = $dbTableLots -> getSingleLot($lotId);


    // show 404 page if lot id doesn't exist
    if (empty($lot) === true) {
        header('Location:/timeline/404.php');
    }


    // init variables
    $lastLotPrice = is_null($lot['last_price']) ? (int)$lot['init_price'] : (int)$lot['last_price'];
    $rateMinStep = (int)$lot['rate_value'];
    $currentMinRate = $lastLotPrice + $rateMinStep;
    $formValidationErrors = [];
    $isRateMadeByCurrentUserID = false;
    $isUserAuth = $initSession -> getIsAuth();


    // check formValidationErrors in all fields ($_POST)
    foreach ($_POST as $key => $value) {
        $validationRules = [
            'minRatePrice' => $fieldsValidation -> verifyValueForRate($_POST['minRatePrice'], $currentMinRate),
        ];

        if (isset($validationRules[$key])) {
            $rule = $validationRules[$key];
            $formValidationErrors[$key] = $rule;
        }
    }


    // clean array from NULL values
    $formValidationErrors = array_filter($formValidationErrors);


    // if form is submitted and there are no validation errors
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && count($formValidationErrors) === 0) {
        // save form values in variables
        $minRatePrice = $_POST['minRatePrice'];
        $currentUserId = $initSession -> getUserId();
        $now = date_create('now') -> format('Y-m-d H:i:s');

        // add new register to database
        $dbTableRates -> insertNewRate($now, $currentUserId, $lotId, $minRatePrice);
        $dbTableLots -> updateSingleLotActualPrice($lotId, $minRatePrice);

        // redirect to the last lot
        header("Location:/timeline/lot.php?&id=$lotId");
    }


    if($initSession -> getIsAuth() === true) {
        $lastLotRate = $dbTableRates -> getLastLotRate($lotId);
        $isRateMadeByCurrentUserID = $lastLotRate !== [] ? (int)$lastLotRate['user_id'] === (int)$initSession -> getUserId() : '';
    }

    // Page HTML
    $htmlMainLayout = $helpers -> includeHtml('mainLayout.php', [
        'pageTitle' => $lot ? $lot['name'] : 'No existe',
        'isUserAuth' => $isUserAuth,
        'currentUserName' => $initSession -> getUserName(),
        'categories' => $dbTableCategories -> getAllCategories(),
        'htmlMainContent' => $helpers -> includeHtml('lot.php', [
            'lot' => $lot,
            'rates' => $dbTableRates -> getAllRatesForSingleLot($lotId),
            'isUserAuth' => $isUserAuth,
            'formValidationErrors' => $formValidationErrors,
            'currentUserId' => $isUserAuth ? $initSession -> getUserId() : '',
            'isRateMadeByCurrentUserID' => $isRateMadeByCurrentUserID,
            'currentMinRate' => $currentMinRate,
            'helpers' => $helpers
        ])
    ]);

    print($htmlMainLayout);
