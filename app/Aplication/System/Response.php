<?php
namespace ThisApp\Aplication\System;

use \ThisApp\Aplication\Security\ErrorLog;
use \ThisApp\Aplication\Security\Session;
use \ThisApp\Aplication\System\Codes;

class Response
{
  static function json($data, $code){   
    header("Access-Control-Allow-Origin: *");
     header(Codes::get($code));
    header("Content-Type: application/json; charset=UTF-8");
    echo json_encode($data);
    exit;
  }
}