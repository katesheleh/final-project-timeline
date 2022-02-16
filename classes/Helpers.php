<?php
class Helpers {

    // connect html template
    public function includeHtml($name, array $data = []) {
        $name = 'templates/' . $name;

        if (!is_readable($name)) {
            return '';
        }

        ob_start();
        extract($data);
        require $name;

        return ob_get_clean();
    }


    // Function to update page for pagination
    public function updatePageNumber($pageNumber) {
        $_GET['page'] = $pageNumber;
        return $_SERVER['SCRIPT_NAME'] . '?' . http_build_query($_GET);
    }


    //  function to show formatted number for price
    public function formatPrice($price) {
        $currency = html_entity_decode('&euro;');

        if (!is_numeric($price)) {
            return $price . ' ' . $currency;
        }

        // round the value
        $price = ceil($price);

        if ($price >= 1000) {
            // added white space for values >= 1000 (thousand divider)
            return number_format($price, 0, '', ' ') . ' ' . $currency;
        } else {
            // do nothing for values < 1000
            return $price . ' ' . $currency;
        } 
    }


    // calculate remaining time for products
    public function getTimeLeft($date) {

        // convert to timestamp
        $now = strtotime('now');
        $expiration = strtotime($date);
        $leftTime = $expiration - $now;

        // 24 hours => 86400
        $leftDays = floor(($leftTime / 86400));
        // 1 hour => 3600
        $leftHours = floor(($leftTime % 86400) / 3600);
        // 1 minute => 60
        $leftMinutes = floor(($leftTime % 3600) / 60);

        return [
            'days' => $leftDays,
            'hours' => $leftHours,
            'minutes' => $leftMinutes
        ];
    }
}
