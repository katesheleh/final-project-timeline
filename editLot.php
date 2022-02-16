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
    $now = date_create('now') -> format('Y-m-d H:i:s');
    $currentUserId = $initSession -> getUserId();
    $currentLotId = $_GET['id'];
    $lot = $dbTableLots -> getSingleLot($currentLotId);
    $categories = $dbTableCategories -> getAllCategories();


    // avoid the user enter the lot id in the url and tries to edit the lot from another user or to edit not active product
    // in this case it will be redirect to the page with the warning
    if($_SERVER['REQUEST_METHOD'] === 'GET' && (((int)$lot['author_id'] !== (int)$currentUserId)) || $lot['expire_date'] < $now) {
        header("Location:/timeline/forbidden.php");
    }


    // if form is submitted
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        // don't change value is the name length is less than 3 and bigger than 105 (like in addLot form validation)
        $lotName = strlen(trim($_POST['lotName'])) < 3 || strlen(trim($_POST['lotName'])) > 105 ? $lot['name'] : trim($_POST['lotName']);
        $lotCategoryId = $_POST['lotCategory'];
        // don't change value is the description length is less than 5 and bigger than 55000 (like in addLot form validation)
        $lotDesc = strlen(trim($_POST['lotDesc'])) < 5 || strlen(trim($_POST['lotDesc'])) > 55000 ? $lot['description'] : trim($_POST['lotDesc']);
        // don't change the value if the init price is less that 0
        $lotInitPrice = $_POST['lotInitPrice'] < 0 ? $lot['init_price'] : $_POST['lotInitPrice'];
        // don't change the value if the init price is less that 0
        $lotRateStep = $_POST['lotRateStep'] < 0 ? $lot['rate_value'] : $_POST['lotRateStep'];

        $dbTableLots -> updateSingleLot($lotName, $lotCategoryId, $lotDesc, $lotInitPrice, $lotRateStep, $currentLotId);

        header("Location:/timeline/myLots.php");
    }


    // Page HTML
    $htmlMainLayout = $helpers -> includeHtml('mainLayout.php', [
        'pageTitle' => 'Editar producto',
        'isUserAuth' => $initSession -> getIsAuth(),
        'currentUserName' => $initSession -> getUserName(),
        'categories' => $categories,
        'htmlMainContent' => $helpers -> includeHtml('editLot.php', [
            'categories' => $categories,
            'lot' => $lot
        ])
    ]);

    print($htmlMainLayout);
