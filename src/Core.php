<?php

namespace Lazarusphp\Orm;

use LazarusPhp\DatabaseManager\Database;
use LazarusPhp\Orm\Traits\Clauses\Grouping;
use LazarusPhp\Orm\Traits\Clauses\Having;
use LazarusPhp\Orm\Traits\Clauses\Joins;
use LazarusPhp\Orm\Traits\Clauses\Limit;
use LazarusPhp\Orm\Traits\Clauses\Order;
use LazarusPhp\Orm\Traits\Clauses\Where;
use LazarusPhp\Orm\Traits\Controllers\Insert;
use LazarusPhp\Orm\Traits\Controllers\Select;
use LazarusPhp\Orm\Traits\Controllers\Update;
use LazarusPhp\Orm\Traits\Controllers\Delete;
use ReflectionClass;

class Core extends Database
{
    // Load Trait Files;
    use Insert;
    use Select;
    use Update;
    use Delete;
    // Load condition Traits
    use Where;
    use Joins;
    use Limit;
    use Order;
    use Grouping;
    use Having;
    // Generate the Param Values
    private $param = [];
    private $sql;
    private $table;
    private $query;

    private  $dev;




    public $data = [];

    public function __set($name, $value)
    {
        $this->param[$name] = $value;
    }


    public function __get($name)
    {
        if (array_key_exists($name, $this->param)) {
            return $this->param[$name];
        }
    }

    public function __isset($name)
    {
        return isset($this->param[$name]);
    }

    public function __unset($name)
    {
    
        unset($this->param[$name]);
    }


    public function __construct()
    {
        Parent::__construct();
        $this->generateTable();
        // Instantiate a Blank $sql statement
        $this->sql = "";
    }

    public function generateTable()
    {
        $class = get_called_class();
        $reflection  = new ReflectionClass($class);
        return $this->table = strtolower($reflection->getShortName());
    }

    public function table($table)
    {
        $this->table = $table;
        return $this;
    }

    public function validateFilters()
    {
        if (count($this->allowed) > 0) {
            $allowed = array_diff($this->allowed, $this->filtered);
            return implode(", ", $allowed);
        } else {
            return "*";
        }
    }

    public function toSql()
    {
        echo $this->sql;
    }

    public  function devtest()
    {
        $this->dev = true;
        return $this;
    }

    public function save()
    {

        // Push Content
        $this->fetchJoins();
        $this->fetchWhere();
        $this->fetchGroupBy();
        $this->fetchHaving();
        $this->fetchOrderBy();
        $this->fetchLimit();
        if($this->dev == true)
        {
            echo $this->sql;
        }
         return $this->GenerateQuery($this->sql,$this->param);

    }
    
        public function get()
        {
            $query = $this->save();
            return $query->fetchAll();
        }

        public  function countRows()
        {
            $query =$this->save();
            $query->rowCount();
        }


        public function first()
        {
            $query = $this->save();
            return $query->fetch();
        }

        public function asJson()
        {
            $query = $this->save();
            $count = $query->rowCount();
            if($count == 1)
            {
               $json = $query->fetch();
            }
            if($count > 1)
            {
               $json = $query->fetchAll();
            }

            header("content-type:application/json");
            return json_encode($json);


        }



}
