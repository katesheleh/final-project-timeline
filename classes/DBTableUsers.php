<?php
require_once('classes/ConnectToDB.php');

class DBTableUsers extends ConnectToDB {
    private $connectToDB;


    public function __construct() {
        $this -> connectToDB = new ConnectToDB();
    }


    public function insertNewUser($now, $email, $password, $name, $contacts) {
        $sqlQuery = "INSERT INTO users (registered_date, email, password, name, contacts) VALUES (?, ?, ?, ?, ?)";

        // hash the password
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // prepare SQL statement
        $stmt = mysqli_prepare($this -> connectToDB -> dbConnection, $sqlQuery);
        // Binds variables to a prepared statement as parameters
        mysqli_stmt_bind_param($stmt, 'sssss', $now, $email, $passwordHash, $name, $contacts);
        // Executes a prepared statement
        mysqli_stmt_execute($stmt);
    }


    public function getSingleUserByEmail($email) {
        $sqlQuery = "SELECT * FROM users WHERE email ='" . mysqli_real_escape_string($this -> connectToDB -> dbConnection, $email) . "';";

         // get the result as array
        $rows = $this -> connectToDB -> fetchDataFromDB($sqlQuery);

        // return empty array if the user doesn't exist
        if(count($rows) === 0) {
            return [];
        }

        // get data for single user
        return $rows[0];
    }


    public function getSingleUserById($id) {
        $sqlQuery = "SELECT * FROM users WHERE id ='" . mysqli_real_escape_string($this -> connectToDB -> dbConnection, $id) . "';";

         // get the result as array
        $rows = $this -> connectToDB -> fetchDataFromDB($sqlQuery);

        // return empty array if the user doesn't exist
        if(count($rows) === 0) {
            return [];
        }

        // get data for single user
        return $rows[0];
    }


    public function updateUserInfo($name, $contacts, $userId) {
        // mysqli_real_escape_string: escapes special characters in a string
        $sqlQuery = "UPDATE users
        SET name = '". mysqli_real_escape_string($this -> connectToDB -> dbConnection, $name) ."',
            contacts = '". mysqli_real_escape_string($this -> connectToDB -> dbConnection, $contacts) ."'
            WHERE id = '" . mysqli_real_escape_string($this -> connectToDB -> dbConnection, $userId) . "'";

        $this -> connectToDB -> executeSqlQuery($sqlQuery);
    }
}
