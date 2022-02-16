<?php
 class LotWinner extends ConnectToDB{
    private $connectToDB;


    public function __construct() {
        $this -> connectToDB = new ConnectToDB();
    }


    private function getLotsWithNullWinnerId($now) {
        $sqlQuery = "SELECT * FROM products WHERE winner_id IS NULL AND expire_date <= '".$now."'";
        return $this -> connectToDB -> fetchDataFromDB($sqlQuery);
    }


    private function updateRateWinner($lotId) {
        $sqlQuery = "UPDATE bets SET winner = 1
            WHERE product_id = '" . mysqli_real_escape_string($this -> connectToDB -> dbConnection, $lotId) . "' ORDER BY created_date DESC LIMIT 1";

        // execute query
        $this -> connectToDB -> executeSqlQuery($sqlQuery);
    }


    private function updateLotWinner($lotId, $winnerId = NULL) {
        $sqlQuery = "UPDATE products
            SET winner_id = '". mysqli_real_escape_string($this -> connectToDB -> dbConnection, $winnerId) ."'
            WHERE id = '" . mysqli_real_escape_string($this -> connectToDB -> dbConnection, $lotId) . "'";

        // execute query
        $this -> connectToDB -> executeSqlQuery($sqlQuery);
    }


    private function getWinnerIdFromLastRate($lotId) {
        $sqlQuery = "SELECT user_id FROM bets WHERE product_id ='". mysqli_real_escape_string($this -> connectToDB -> dbConnection, $lotId) ."' ORDER BY created_date DESC LIMIT 1";
        $rows =  $this -> connectToDB -> fetchDataFromDB($sqlQuery);

        // return empty array if the user doesn't exist
        if(count($rows) === 0) {
            return NULL;
        }

        // get data for single user
        return $rows[0]["user_id"];
    }


    public function getLotsWinners($now) {
        $lotsWithoutWinner = $this -> getLotsWithNullWinnerId($now);

        foreach ($lotsWithoutWinner as $lot) {
            $lotId = $lot['id'];
            $winnerId = $this -> getWinnerIdFromLastRate($lotId);

            $this -> updateLotWinner($lotId, $winnerId);
            $this -> updateRateWinner($lotId);

        }
    }

 }
