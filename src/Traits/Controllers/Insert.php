<?php
namespace LazarusPhp\QueryBuilder\Traits\Controllers;

trait Insert
{
    public function insert(array $data = [])
    {
        if (count($data) === 0) {
            
            $keys = implode(',', array_keys($this->param));
            $placeholders = ':' . implode(', :', array_keys($this->param));
        } else {
            // If Array is passed
            $keys = implode(',', array_keys($data));
            $placeholders = ':' . implode(', :', array_keys($data));
            $this->param = $data;
        }
        $this->sql .= "INSERT INTO " . $this->table ;
        $this->sql .= " ($keys) ";
        $this->sql .= "VALUES($placeholders)";
        return $this->save($this->sql,$this->param);
    }

    public function replace(array $data = [])
    {
        if (count($data) === 0) {
            
            $keys = implode(',', array_keys($this->param));
            $placeholders = ':' . implode(', :', array_keys($this->param));
        } else {
            // If Array is passed
            $keys = implode(',', array_keys($data));
            $placeholders = ':' . implode(', :', array_keys($data));
            $this->param = $data;
        }
        $this->sql .= "REPLACE INTO " . $this->table ;
        $this->sql .= " ($keys) ";
        $this->sql .= "VALUES($placeholders)";
        return $this->save($this->sql,$this->param);
    }
}