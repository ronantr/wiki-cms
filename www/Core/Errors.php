<?php

namespace App\Core;
use App\Core\View;

class Error 
{
    public static function errorPage($responseCode, $messageSent = ""){
        $responseMessage = $messageSent !== "" ? $messageSent : self::$_responseCodes[strval($responseCode)];
        header($responseMessage, true, $responseCode);
        $view = new View("Errors/error", "error");
        $view->assign('responseCode', $responseCode);
    }
}