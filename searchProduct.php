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
    require_once('classes/SearchLots.php');
    require_once('classes/Helpers.php');


    // init classes
    $initSession = new InitSession();
    $dbTableCategories = new DBTableCategories();
    $searchLots = new SearchLots();
    $helpers = new Helpers();


    // init variables
    $textForSearch = '';
    $foundedProducts = [];
    $currentPage = 1;
    $pages = 1;
    $pagesTotal = 1;
    $now = date_create('now') -> format('Y-m-d H:i:s');


    // if form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        // pagination
        $textForSearch = trim($_GET['search']);
        $preparedStringForSearch = $searchLots -> prepareSearchExpression($textForSearch);

        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
        $productsPerPage = 6;

        $lotsResultTotal = $searchLots -> countFoundedLots($preparedStringForSearch, $now);

        $pagesTotal = ceil($lotsResultTotal / $productsPerPage);
        $offset = ($currentPage - 1) * $productsPerPage;
        $pages = range(1, $pagesTotal);

        $foundedProducts = $searchLots -> getFoundedLots($preparedStringForSearch, $productsPerPage, $offset, $now);
    }


    // Page HTML
    $htmlMainLayout = $helpers -> includeHtml('mainLayout.php', [
        'pageTitle' => 'Búsqueda',
        'isUserAuth' => $initSession -> getIsAuth(),
        'currentUserName' => $initSession -> getUserName(),
        'categories' => $dbTableCategories -> getAllCategories(),
        'htmlMainContent' => $helpers -> includeHtml('searchProduct.php', [
            'textForSearch' => $textForSearch,
            'foundedProducts' => $foundedProducts,
            'currentPage' => $currentPage,
            'pages' => $pages,
            'pagesTotal' => $pagesTotal,
            'helpers' => $helpers
        ])
    ]);

    print($htmlMainLayout);
