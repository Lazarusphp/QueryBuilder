<?php

namespace LazarusPhp\Orm\Traits\Conditions;

trait Order
{

    private $order;

    public function orderBy($value,$direction="ASC")
    {
        $orderParam = uniqid("order_");
        $directionparam = uniqid("direction_");
        $direction = strtoupper($direction);
        $this->order = " ORDER BY $value $direction ";
        return $this;
    }

    public function fetchOrderBy()
    {
        // echo $this->order;
        $this->sql .= $this->order;
    }
}