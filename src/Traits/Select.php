<?php
namespace LazarusPhp\Orm\Traits;

trait Select
{
    public function select($alias = null)
    {
            $this->newFlag("select");
            $this->sql .= "SELECT ". $this->validateFilters() . "  FROM " . $this->table;
            if (!is_null($alias)) {
                $this->sql .= " ACS $alias ";
            }
            return $this;
    }
}