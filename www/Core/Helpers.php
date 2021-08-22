<?php

namespace App\Core;

/**
 * Class Helpers
 * @package App\Core
 * Class that defines helper functions that can be used throughout the code
 */

class Helpers {

    public static function cleanFirstname($firstname) {
        return ucwords(mb_strtolower(trim($firstname)));
    }


    public static function debug($param) {
        echo '<pre>';
        print_r($param);
        echo '</pre>';
    }

    public function filter(&$value) {
        $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }

    static function cleanArray($array) {
        array_walk_recursive($array, array(new Helpers() , 'filter'));
        return $array;
    }

    static function generateCsrfToken() {
        if (empty($_SESSION['csrf'])) {
            $_SESSION['csrf'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf'];
    }


}