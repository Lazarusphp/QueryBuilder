<?php
namespace LazarusPhp\Orm\Traits\Conditions;

trait Where
{
    public $where = [];
       // Start Where()
       public function where($key,$value,$operator=null)
       {
           $operator = $operator ?? "=";
           $params = uniqid("where_");
            $condition = $key.$operator.":$params";
             if(count($this->where))
             {
                 $condition = " AND " . $condition;
             }
             $this->where[] = $condition;
             $this->param[$params] = $value;
             return $this;
       }

    //    Allow Sql to Pass OR to the Where Statement
       public function orWhere($key,$value,$operator=null)
       {
           $operator = $operator ?? "=";
           $params = uniqid("orWhere_");
            $condition = $key.$operator.":$params";
             if(count($this->where))
             {
                 $condition = " OR " . $condition;
             }
             $this->where[] = $condition;
             $this->param[$params] = $value;
             return $this;
       }


       public function fetchWhere()
       {
            $wherecond = [];
            $wheres = $this->where;
            if (!empty($wheres)) {
                $this->sql .= " WHERE ";
                foreach ($wheres as $where) {
                    $wherecond[] = $where;
                }
                $this->sql .= implode(" ", $wherecond);
            }
            return $this;
        }

          
       // End WHere
}