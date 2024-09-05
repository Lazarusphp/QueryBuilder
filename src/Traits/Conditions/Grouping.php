<?php

namespace LazarusPhp\Orm\Traits\Conditions;

trait Grouping
{
    private $group;
    public function groupBy($value)
    {
        $this->group = "GROUP BY $value";
        return $this;
    }

    public function fetchGroupBy ()
    {

        $this->sql .= $this->group;
    }

}