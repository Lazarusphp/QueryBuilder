<?php

namespace LazarusPhp\Orm\Traits\Conditions;

trait Joins
{
    protected  $joins  = [];
    public  function innerJoin($table,$alias=null)
    {
        $this->joins[] = " INNER JOIN $table ";
        if(!is_null($alias))
        {
         $this->joins[] = " $alias ";
        }
        return $this;
    }

    public  function rightJoin($table,$alias)
    {
        $this->joins[] = " RIGHT JOIN $table $alias ";
        return $this;

    }

    public  function leftJoin($table,$alias)
    {
        $this->joins[] = " RIGHT JOIN  $table $alias ";
        return $this;
    }

    public  function fullJoin($table,$alias)
    {
        $this->joins[] = " FULL JOIN  $table $alias ";
        return $this;
    }


    public  function  on($key,$value)
    {
        $condition = "$key=$value";
        $this->joins[] = "ON $condition";
        return $this;
    }

    public  function fetchJoins()
    {
        $joins = [];
        if(count($this->joins)) {
            foreach ($this->joins as $join) {
                $joins[] = $join;
            }
            $this->sql .= implode(" ", $joins);
        }
    }
}