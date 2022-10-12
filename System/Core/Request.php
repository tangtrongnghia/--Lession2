<?php

namespace System\Core;

use Exception;

class Request
{
    protected function isMethod($method = 'get')
    {
        if($_SERVER['REQUEST_METHOD'] !== strtoupper($method))
        {
            if(isset($_SERVER['CONTENT_TYPE']) && strtolower($_SERVER['CONTENT_TYPE']) == 'application/x-www-form-urlencoded'){
                echo json_encode(['error' => true, 'message' => "Method $method not support"]);
            }else{
                throw new Exception("Method $method not support", 500);
            }
        }
        
        return $method;
    }

    protected function input($key = '')
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            return empty($key) ? $_POST :
            (isset($_POST[$key]) && !is_null($_POST[$key]) ? makeSafe($_POST[$key]) : null);
        }

        if($_SERVER['REQUEST_METHOD'] == 'GET')
        {
            return empty($key) ? $_GET :
            (isset($_GET[$key]) && !is_null($_GET[$key]) ? makeSafe($_GET[$key]) : null);
        }

        return null;
    }
}