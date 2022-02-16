<?php
class SearchLots extends ConnectToDB{
    private $connectToDB;


    public function __construct() {
        $this -> connectToDB = new ConnectToDB();
    }


    public function prepareSearchExpression($text) {
        // string to array
        $expressionAsArray = explode(' ', $text);
        $readyExpression = '';

        foreach ($expressionAsArray as $item) {
            // if not empty
            if(strlen($item) > 0) {
                // add symbol(placeholder) in the end of every expression and save it as string
                $readyExpression = trim($readyExpression) . trim($item) . '* ';
            }
        }
        return trim($readyExpression);
    }


    public function countFoundedLots($text, $now) {
        $sqlQuery = "SELECT COUNT(*) as total FROM products p WHERE expire_date > '".$now."' AND MATCH(p.name, p.description) AGAINST('" . mysqli_real_escape_string(
                $this -> connectToDB -> dbConnection, $text) . "' IN BOOLEAN MODE);";

        $result = mysqli_query($this -> connectToDB -> dbConnection, $sqlQuery);

        return mysqli_fetch_assoc($result)['total'];
    }


    public function getFoundedLots($text, $productsPerPage, $offset, $now) {

        // offset is a parameter for pagination
        $sqlQuery = "SELECT p.id, p.name, init_price, image, c.name as category_name, p.expire_date
        FROM products p JOIN categories c ON category_id = c.id
        WHERE expire_date > '".$now."' AND MATCH(p.name, p.description) AGAINST('" . mysqli_real_escape_string(
        $this -> connectToDB -> dbConnection, $text) . "' IN BOOLEAN MODE) ORDER BY id DESC LIMIT " . $productsPerPage . " OFFSET " . $offset . ";";

        return $this -> connectToDB -> fetchDataFromDB($sqlQuery);
    }
}
