<?php

class DBTableCategories extends ConnectToDB {
    private $connectToDB;


    public function __construct() {
        $this -> connectToDB = new ConnectToDB();
    }


    public function getAllCategories() {

        $sqlQuery = 'SELECT * FROM categories';

        return $this -> connectToDB -> fetchDataFromDB($sqlQuery);
    }


    public function getSingleCategory($category) {

        // mysqli_real_escape_string escapes special characters in a string in SQL
        $sqlQuery = "SELECT * FROM categories
        WHERE tech_value = '" . mysqli_real_escape_string($this -> connectToDB -> dbConnection, $category) . "'";

        // get all categories as array
        $rows = $this -> connectToDB -> fetchDataFromDB($sqlQuery);

        // return empty array if the result is empty
        if (count($rows) === 0) {
            return [];
        }

        // return single category data
        return $rows[0];
    }
}
