<?php
namespace LazarusPhp\Orm\Traits\Controllers;

trait Insert
{
    public function insert()
    {
        $keys = implode(',',array_keys($this->param));
        $placeholders = ':' . implode(', :', array_keys($this->param));
        $this->sql .= "INSERT INTO " . $this->table ;
        $this->sql .= " ($keys) ";
        $this->sql .= "VALUES($placeholders)";
        return $this;
    }
}