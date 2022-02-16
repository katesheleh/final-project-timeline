<?php

class ConnectToDB {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $db = "timeline";
    public $dbConnection;

    public function __construct() {
        // connect to DB
        $this->dbConnection = mysqli_connect($this -> host, $this -> username, $this -> password, $this -> db);

        // setup encoding format
        mysqli_set_charset($this->dbConnection, 'utf8');

        // errors handling
        if (!$this->dbConnection) {
            $this->dbError = mysqli_connect_error();
        }
    }

    public function fetchDataFromDB($sqlQuery) {
        // error handling
        if (!$this->dbConnection) {
            $this->dbError = mysqli_connect_error();
        }

        // get sql query result
        $result = mysqli_query($this->dbConnection, $sqlQuery);

        // result as array
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function executeSqlQuery($sqlQuery) {
        // error handling
        if (!$this->dbConnection) {
            $this->dbError = mysqli_connect_error();
        }

        // execute sql
        return mysqli_query($this->dbConnection, $sqlQuery);
    }
}
