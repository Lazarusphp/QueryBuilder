<?php

namespace LazarusPhp\Orm\Traits\Conditions;

trait Order
{

    private $order;

    public function orderBy($direction, ...$values)
    {
        $direction = strtoupper($direction);
        if(!in_array($direction, ['ASC', 'DESC']))
        {
            trigger_error("Invalid Direction");
        }

        $args = implode(", ",$values);
        $this->order = " ORDER BY  $args $direction ";
        return $this;
    }

    public function fetchOrderBy()
    {
        // echo $this->order;
        $this->sql .= $this->order;
    }
}