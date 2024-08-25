<?php
namespace LazarusPhp\Orm\Traits;

trait Insert
{
    public function insert()
    {
        $this->newFlags("insert");
        $this->sql .= "Insert into " . $this->table ;
        $this->sql .= "(".implode(",",array_keys($this->params)).")";
    }
}