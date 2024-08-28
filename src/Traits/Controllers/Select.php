<?php
namespace LazarusPhp\Orm\Traits\Controllers;


trait Select
{
    public function select(...$args)
    {      
            if(count($args) > 0)
            (count($args) > 0) ? $args = implode(",",$args) : $args = "*";
            $this->sql .= "SELECT $args FROM " . $this->table;
            return $this;
    }

    public function as($alias)
    {
        $this->sql .= " AS $alias ";
        return $this;
    }
}