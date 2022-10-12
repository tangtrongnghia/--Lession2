<?php

namespace System\Core;

use Exception;
use mysqli;

class Database
{
    protected $conn;

    public function __construct()
    {
        global $_Config;
        $this->connectMysql($_Config['database']);
    }

    protected function connectMysql($info = []){
        $this->conn = new mysqli($info['hostname'], $info['username'], $info['password'], $info['dbname']);
        if($this->conn->connect_error)
        {
            throw new Exception('Mysql - Connect Error');
        }
        $this->conn->set_charset($info['charset']);

        return $this;
    }
}