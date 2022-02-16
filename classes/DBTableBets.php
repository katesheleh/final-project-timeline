<?php

class DBTableBets extends ConnectToDB {
    private $connectToDB;


    public function __construct() {
        $this -> connectToDB = new ConnectToDB();
    }


    public function getAllRatesForSingleLot($lotId) {
        // '?' is a placeholder for parameter to pass
        $sqlQuery = "SELECT created_date, price, u.name as user_name FROM bets b JOIN users u ON b.user_id = u.id
            WHERE b.product_id = ? ORDER BY created_date DESC";

        // prepare SQL statement
        $stmt = mysqli_prepare($this -> connectToDB -> dbConnection, $sqlQuery);
        // Bind variables to the statement
        // 's' is type string
        mysqli_stmt_bind_param($stmt, 's', $lotId);
        // Execute the statement
        mysqli_stmt_execute($stmt);
        // Get result from the statement
        $result = mysqli_stmt_get_result($stmt);
        // get array
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }


    public function insertNewRate($now, $userId, $lotId, $betValue) {
        // '?' is a placeholder for parameter to pass
        $sqlQuery = "INSERT INTO bets (created_date, user_id, product_id, price) VALUES (?, ?, ?, ?)";

        // prepare SQL statement
        $stmt = mysqli_prepare($this -> connectToDB -> dbConnection, $sqlQuery);
        // Bind variables to the statement
        // 's' is type string
        // 'd' is decimal
        // 'i' is integer
        mysqli_stmt_bind_param($stmt, 'siid', $now, $userId, $lotId, $betValue);
        // Execute the statement
        mysqli_stmt_execute($stmt);
    }


    public function getLastLotRate($lotId) {
        // mysqli_real_escape_string: escapes special characters in a string
        $sqlQuery = "SELECT * FROM bets WHERE product_id = '" . mysqli_real_escape_string($this -> connectToDB -> dbConnection, $lotId) . "'
            ORDER BY created_date DESC LIMIT 1";

        $rows = $this -> connectToDB -> fetchDataFromDB($sqlQuery);

        if (count($rows) === 0) {
            return [];
        }

        return $rows[0];
    }


    public function getAllRatesOfSingleUser($currentUserId) {
        // mysqli_real_escape_string: escapes special characters in a string
        $sqlQuery = "SELECT p.id as product_id, p.image, p.name as product_name, p.author_id as product_author_id, c.name as cat_name, p.expire_date, b.price as rate_value,
            b.id as rate_id, b.created_date as rate_created, b.winner as is_won
            FROM products p 
            JOIN categories c ON category_id = c.id 
            JOIN bets b ON b.product_id = p.id 
            JOIN users u ON b.user_id = u.id
            WHERE b.user_id = '" . mysqli_real_escape_string($this -> connectToDB -> dbConnection, $currentUserId) . "' ORDER BY b.created_date DESC";

        // get items as array
        return $this -> connectToDB -> fetchDataFromDB($sqlQuery);
    }
}
