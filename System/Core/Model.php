<?php

namespace System\Core;

use Exception;

abstract class Model extends Database
{
    abstract protected function table();
    
    public function query($sql = '')
    {
        if($sql == '')
        {
            throw new Exception('Sql Empty', 500);
        }

        $result = $this->conn->query($sql);

        return $result ? $result : null;
    }

    public function getAll($sql= '')
    {
        $result = $this->query($sql);
        if(is_null($result)) return null;

        $data = [];

        while ($row = $result->fetch_assoc())
        {
            $data[] = $row;
        }
        
        return $data;
    }

    public function insertArray($data = null, $table = null)
    {
        if (is_null($data) || is_null($table)) {
            throw new Exception('Data hoặc table is empty', 500);
        }

        $field = $val = '';
        foreach ($data as $key => $value) {
            $field  .= $key . ', ';
            $val    .= "'" . $value . "', ";
        }
        $field  = substr($field, 0, -2);
        $val    = substr($val, 0, -2);
        $sql    = "INSERT INTO $table ($field) VALUES ($val)";

        return $this->query($sql);
    }

    public function getFirst($sql = '')
    {
        $result = $this->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }

        return null;
    }

    public function updateArray($data = null, $table = null, $id = null)
    {
        if (is_null($data) || is_null($table) || is_null($id)) {
            throw new Exception('Data || table || ID is empty', 500);
        }
        
        $col_val = '';
        foreach ($data as $key => $value) {
            $col_val .= $key . " = '$value', ";
        }
        $col_val  = substr($col_val, 0, -2);
        $sql    = "UPDATE $table SET $col_val WHERE id = $id";

        return $this->query($sql);
    }

}