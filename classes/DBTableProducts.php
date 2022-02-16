<?php
class DBTableProducts extends ConnectToDB {
    private $connectToDB;


    public function __construct() {
        $this -> connectToDB = new ConnectToDB();
    }


    public function getActiveLots($limit, $now) {
        $sqlQuery = "SELECT p.id, p.name, init_price, image, c.name as cat_name, expire_date
        FROM products p JOIN categories c ON category_id = c.id WHERE expire_date > '".$now."' ORDER BY created_date DESC LIMIT $limit";

        // get result as array
        return $this -> connectToDB -> fetchDataFromDB($sqlQuery);
    }


    public function getAllLotsForSingleUser($userId, $lotsPerPage, $offset) {
        // mysqli_real_escape_string: escapes special characters in a string
        $sqlQuery = "SELECT p.id, p.name, p.init_price, p.image, p.author_id, c.name as cat_name, p.expire_date
        FROM products p JOIN categories c ON category_id = c.id
        WHERE p.author_id = '" . mysqli_real_escape_string($this -> connectToDB -> dbConnection, $userId) . "'
        ORDER BY created_date DESC LIMIT " . $lotsPerPage . " OFFSET " . $offset . ";";

        // get result as array
        return $this -> connectToDB -> fetchDataFromDB($sqlQuery);
    }


    public function getActiveLotsInSingleCategory($category, $lotsPerPage, $offset, $now) {
        // mysqli_real_escape_string: escapes special characters in a string
        $sqlQuery = "SELECT p.id, p.name, p.init_price, p.image, c.name as cat_name, p.expire_date
        FROM products p JOIN categories c ON category_id = c.id
        WHERE expire_date > '".$now."' AND tech_value = '" . mysqli_real_escape_string($this -> connectToDB -> dbConnection, $category) . "'
        ORDER BY created_date DESC LIMIT " . $lotsPerPage . " OFFSET " . $offset . ";";

        // get result as array
        return $this -> connectToDB -> fetchDataFromDB($sqlQuery);
    }


    public function countAllLotsForSingleUser($userId) {
        $sqlQuery = "SELECT COUNT(*) as products_total FROM products p JOIN categories c ON category_id = c.id
        WHERE p.author_id  = '" . mysqli_real_escape_string($this -> connectToDB -> dbConnection, $userId) . "'";

        $result = mysqli_query($this -> connectToDB -> dbConnection, $sqlQuery);

        return mysqli_fetch_assoc($result)['products_total'];
    }


    public function countActualLotsForSingleCategory($currentCategoryTechnicalName, $now) {
        $sqlQuery = "SELECT COUNT(*) as products_total FROM products p JOIN categories c ON category_id = c.id
        WHERE tech_value = '" . mysqli_real_escape_string($this -> connectToDB -> dbConnection, $currentCategoryTechnicalName) . "' AND expire_date > '".$now."'";

        $result = mysqli_query($this -> connectToDB -> dbConnection, $sqlQuery);

        return mysqli_fetch_assoc($result)['products_total'];
    }


    public function getSingleLot($lotId) {

        // '?' is a placeholder for parameter to pass
        $sqlQuery = "SELECT p.id as product_id, p.author_id, p.name, p.description, p.rate_value, p.init_price, p.last_price, p.image, p.expire_date,
        c.name as category_name, c.id as category_id
        FROM products p JOIN categories c ON category_id = c.id WHERE p.id = ?";

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
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

        if (count($rows) === 0) {
            return [];
        }

        // we receive result as array, so we need to have a first element
        return $rows[0];
    }


    public function updateSingleLotActualPrice($lotId, $actualPrice) {
        // mysqli_real_escape_string: escapes special characters in a string
        $sqlQuery = "UPDATE products SET last_price = '". mysqli_real_escape_string($this -> connectToDB -> dbConnection, $actualPrice) ."'
            WHERE id = '" . mysqli_real_escape_string($this -> connectToDB -> dbConnection, $lotId) . "'";

        $this -> connectToDB -> executeSqlQuery($sqlQuery);
    }


    public function updateSingleLot($name, $categoryId, $description, $initPrice, $rateValue, $lotId) {
        // mysqli_real_escape_string: escapes special characters in a string
        $sqlQuery = "UPDATE products
        SET name = '". mysqli_real_escape_string($this -> connectToDB -> dbConnection, $name) ."',
            category_id = '". mysqli_real_escape_string($this -> connectToDB -> dbConnection, $categoryId) ."',
            description = '". mysqli_real_escape_string($this -> connectToDB -> dbConnection, $description) ."',
            init_price = '". mysqli_real_escape_string($this -> connectToDB -> dbConnection, $initPrice) ."',
            rate_value = '". mysqli_real_escape_string($this -> connectToDB -> dbConnection, $rateValue) ."'
            WHERE id = '" . mysqli_real_escape_string($this -> connectToDB -> dbConnection, $lotId) . "'";

        $this -> connectToDB -> executeSqlQuery($sqlQuery);
    }


    public function insertNewSingleLot($now, $lotName, $lotDesc, $rateMin, $initialPrice, $image, $expiresAt, $catId, $authorId) {
        // '?' is a placeholder for parameter
        $sqlQuery = "INSERT INTO products
        (created_date, name, description, rate_value, init_price, image, expire_date, category_id, author_id)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // prepare SQL statement
        $stmt = mysqli_prepare($this -> connectToDB -> dbConnection, $sqlQuery);
        // Binds variables to the statement
        // 's' is string
        // 'd' is decimal
        // 'i' is integer
        mysqli_stmt_bind_param($stmt, 'sssddssii', $now, $lotName, $lotDesc, $rateMin, $initialPrice, $image, $expiresAt, $catId, $authorId);
        // Execute the statement
        mysqli_stmt_execute($stmt);
    }


    public function deleteLot($lotId) {
        // mysqli_real_escape_string: escapes special characters in a string
        $sqlQuery = "DELETE FROM products WHERE id = '" . mysqli_real_escape_string($this -> connectToDB -> dbConnection, $lotId) . "'";

        $this -> connectToDB -> executeSqlQuery($sqlQuery);
    }


    public function getLastCreatedLotId() {
        return mysqli_insert_id($this -> connectToDB -> dbConnection);
    }
}
