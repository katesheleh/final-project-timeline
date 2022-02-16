<?php

    // init session
    if(!isset($_SESSION)){
        session_start();
    }


    // include files
    require_once('classes/ConnectToDB.php');
    require_once('classes/DBTableUsers.php');
    require_once('classes/InitSession.php');


    // init classes
    $initSession = new InitSession();


    // empty session data
    $initSession -> destroy();


    // redirect to index.php
    header("Location:/timeline/index.php");
