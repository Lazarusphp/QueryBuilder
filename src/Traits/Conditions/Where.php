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

       public function in($key,...$values)
       {

           $results = [];
           foreach($values as $value)
           {
               $param = uniqid("in_");
               $results[] = ":$param";
               $this->param[$param] = $value;
           }
           $this->where[] = "$key IN (" . implode(", ",$results).")";
           return $this;
       }


        public function like($key,$value)
        {
            $param = uniqid("like_");

            $condition = "$key LIKE :$param";
            if(count($this->where))
            {
                $condition = "AND $condition";
            }

            $this->where[] = $condition;
            $this->param[$param] = $value;
            return $this;
        }

       public  function orLike($key,$value)
       {
        $param = uniqid("orLike_");

        $condition = "$key LIKE :$param";
        if(count($this->where))
        {
            $condition = "OR $condition";
        }

           $this->where[] = $condition;
           $this->param[$param] = $value;
        return $this;
       }


       public  function notLike($key,$value)
       {
        $param = uniqid("notLike_");

        $condition = "$key NOT LIKE :$param";
        if(count($this->where))
        {
            $condition = "AND $condition";
        }

           $this->where[] = $condition;
           $this->param[$param] = $value;
        return $this;
       }

    public  function orNotLike($key,$value)
    {
        $param = uniqid("orNotLike_");

        $condition = "$key NOT LIKE :$param";
        if(count($this->where))
        {
            $condition = "OR $condition";
        }

        $this->where[] = $condition;
        $this->param[$param] = $value;
        return $this;
    }




//       Reverse to In
//Display ALl results that will show results other than those called
    public function notIn($key,...$values)
    {

        $results = [];
        foreach($values as $value)
        {
            $param = uniqid("notIn_");
            $results[] = ":$param";
            $this->param[$param] = $value;
        }
        $this->where[] = "$key NOT IN (" . implode(", ",$results).")";
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

       public  function  between(string $key, int $value,int $value2)
       {
           $param = uniqid("between_");
           $param2 = uniqid("between_");
           $condition = "$key BETWEEN :$param AND :$param2";

           if(count($this->where))
           {
               $condition = " AND " . $condition;
           }

           $this->where[] = $condition;
           $this->param[$param] = $value;
           $this->param[$param2] = $value2;
           return $this;
       }

       public  function  orbetween(string $key, int $value,int $value2)
       {
           $param = uniqid("orBetween_");
           $param2 = uniqid("orBetween_");
           $condition = "$key BETWEEN :$param AND :$param2";

           if(count($this->where))
           {
               $condition = " OR " . $condition;
           }

           $this->where[] = $condition;
           $this->param[$param] = $value;
           $this->param[$param2] = $value2;
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