<?php

namespace LazarusPhp\Orm\Traits\Clauses;

trait Having
{
    protected $having = [];
    public function having($key, $value, $operator = null)
    {
        $param = uniqid("having_");
        $operator=$operator ?? "=";
        $condition  = "$key $operator $param ";
        $this->having[] = $condition;

        $this->param[$param] = $value;
        return $this;
    }


    protected  function fetchHaving()
    {
        $this->sql .= implode(" ",$this->having);
    }
}