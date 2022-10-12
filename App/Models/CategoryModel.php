<?php

namespace App\Models;

use System\Core\Model;

class CategoryModel extends Model
{
    protected $table = 'categories';

    public function get()
    {
        $sql = "SELECT * FROM $this->table";

        return $this->getAll($sql);
    }

    protected function table()
    {
        return $this->table;
    }
}
