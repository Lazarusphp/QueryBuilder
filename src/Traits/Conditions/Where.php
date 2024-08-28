<?php
namespace LazarusPhp\Orm\Traits\Conditions;

trait Where
{
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

       public function findById($id)
       {
        $params = uniqid("where_");
        $condition = "id=:$params";
        $this->where[] = $condition;
        $this->param[$params] = $id;
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