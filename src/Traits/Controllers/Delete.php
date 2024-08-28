<?php
namespace LazarusPhp\Orm\Traits\Controllers;

trait Delete
{
    
    public function delete()
    {
        $this->newFlags("delete");
        $this->sql .= "DELETE FROM ". $this->table . " ";
        return $this;
    }
}