<?php

namespace System\Core;

use Exception;

class App extends Route
{
    public function __construct()
    {
        try{
            parent::__construct();
            
            if(!is_null($this->query) && $this->controller == 'MainController')
            {
                throw new Exception('404', 404);
            }

            $nameController = "App\\Controllers\\" . $this->controller;
            $classController = new $nameController;
            
            if(!method_exists($classController, $this->method))
            {
                throw new Exception('Method ' . $this->method . '() not exist in ' . $nameController, 500);
            }

            call_user_func_array([$classController, $this->method], $this->params);
        }catch (Exception $err){
            $this->viewError($err->getCode(), $err);
        }
    }

    protected function viewError($code, $err)
    {
        if(file_exists(__VIEW__ . 'errors/' . $code . '.php'))
        {
            include __VIEW__ . 'errors/' . $code . '.php';
            exit;
        }

        include __DIR__ . '/../Views/' . $code . '.php';
    }

}