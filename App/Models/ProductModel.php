<?php

namespace App\Models;

use System\Core\Model;

class ProductModel extends Model
{
    protected $table = 'products';

    public function insert($data = [])
    {
        return $this->insertArray($data, $this->table);
    }

    public function get($limit = 10, $offset = 0, $search = null)
    {   
        $sql = "SELECT $this->table.id, $this->table.name, $this->table.thumb, categories.name as category, categories.id as category_id
        FROM $this->table LEFT JOIN categories ON $this->table.category_id = categories.id";

        if($search) {
            $sql .= " WHERE $this->table.name like '%". $search ."%' OR categories.name like '%". $search ."%'";
        }

        $sql .= " ORDER BY $this->table.id desc LIMIT $limit OFFSET $offset";

        return  $this->getAll($sql);
    }

    public function getCountAll($search = null)
    {
        $sql = "SELECT $this->table.id FROM $this->table LEFT JOIN categories ON $this->table.category_id = categories.id";

        if($search) {
            $sql .= " WHERE $this->table.name like '%". $search ."%' OR categories.name like '%". $search ."%'";
        }

        return $this->query($sql);
    }

    public function show($id)
    {
        $sql="SELECT * FROM $this->table WHERE id = $id";

        return $this->getFirst($sql);
    }

    public function delete($id = '')
    {
        return $this->query("DELETE FROM $this->table WHERE id = $id");
    }

    public function update($data = [], $id)
    {
        return $this->updateArray($data, $this->table, $id);
    }

    protected function table()
    {
        return $this->table;
    }
}