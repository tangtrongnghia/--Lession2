<?php

namespace System\Core;

use Exception;

class Controller extends Request
{
    public function view($master, $data)
    {
        if(! file_exists(__VIEW__ . $master . '.php'))
        {
            throw new Exception('File not found', 500);
        }

        extract($data);

        include __VIEW__ . $master . '.php';
    }
}