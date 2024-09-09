<?php

namespace LazarusPhp\QueryBuilder\Traits\Clauses;

trait Limit
{

    public  $limit = [];
    public function limit($start,$end=null)
    {
        $parammin = uniqid("limitMin_");
        $paramend= uniqid("limitEnd_");

        $this->limit[] =  " LIMIT :$parammin ";
        $this->param[$parammin] = $start;
        if(!is_null($end))
            {
                $this->limit[] = ", :$paramend";
                $this->param[$paramend] = $end;
            }



        return $this;
    }


    public function fetchLimit()
    {
        $mewLimit = [];
        if(count($this->limit))
        {
            foreach ($this->limit as $limit)
            {
                $newLimit[] = $limit;
            }
            $this->sql .= implode(" ", $newLimit);
        }
    }
}