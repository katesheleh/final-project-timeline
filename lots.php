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


    // init variables
    $lotsInCategory = [];
    $now = date_create('now') -> format('Y-m-d H:i:s');
    // number of products per page
    $lotsPerPage = 6;

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        // pagination
        $currentCategoryTechnicalName = isset($_GET['category']) ? $_GET['category'] : '';
        $currentCategoryData = $dbTableCategories -> getSingleCategory($currentCategoryTechnicalName);
        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
        
        $lotsTotal = $dbTableLots -> countActualLotsForSingleCategory($currentCategoryTechnicalName, $now);

        $pagesTotal = ceil($lotsTotal / $lotsPerPage);
        $offset = ($currentPage - 1) * $lotsPerPage;
        $pages = range(1, $pagesTotal);

        $lotsInCategory = $dbTableLots -> getActiveLotsInSingleCategory($currentCategoryTechnicalName, $lotsPerPage, $offset, $now);
    }


    // Page HTML
    $htmlMainLayout = $helpers -> includeHtml('mainLayout.php', [
        'pageTitle' => $currentCategoryData ? $currentCategoryData['name'] : 'Categoría',
        'isUserAuth' => $initSession -> getIsAuth(),
        'currentUserName' => $initSession -> getUserName(),
        'categories' => $dbTableCategories -> getAllCategories(),
        'htmlMainContent' => $helpers -> includeHtml('lots.php', [
            'lots' => $lotsInCategory,
            'currentCategoryData' => $currentCategoryData,
            'currentPage' => $currentPage,
            'pages' => $pages,
            'pagesTotal' => $pagesTotal,
            'helpers' => $helpers
        ])
    ]);

    print($htmlMainLayout);
