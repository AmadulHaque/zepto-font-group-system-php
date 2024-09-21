<?php

namespace App\Models;

use App\Core\Model;

class Font extends Model
{
    protected $table = 'fonts';


    public function insert($data)
    {
        $sql = "INSERT INTO {$this->table} (name, path) VALUES (:name, :path)";
        return $this->query($sql, $data);
    }


    public function getAll()
    {
        $sql = "SELECT * FROM {$this->table}";
        return $this->query($sql);
    }
    

    public function find($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = $this->query($sql, ['id' => $id]);
        return $stmt ? $stmt[0] : null;
    }
    
    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        return $this->query($sql, ['id' => $id]);
    }
    
    

}
