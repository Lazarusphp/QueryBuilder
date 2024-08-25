<?php
namespace LazarusPhp\Orm\Traits;

trait Select
{
    public function select($items = null, $alias = null)
    {
            $this->newFlag("select");
            $items = $items ?? "*";
            $this->sql .= "SELECT $items  FROM " . $this->table;
            if (!is_null($items) && !is_null($alias)) {
                $this->sql .= " AS $alias ";
            }
            return $this;
    }
}
?>