<?php

namespace Lazarusphp\QueryBuilder;

use LazarusPhp\DatabaseManager\Database;
use LazarusPhp\DatabaseManager\QueryBuilder;
use LazarusPhp\QueryBuilder\Traits\Clauses\Grouping;
use LazarusPhp\QueryBuilder\Traits\Clauses\Having;
use LazarusPhp\QueryBuilder\Traits\Clauses\Joins;
use LazarusPhp\QueryBuilder\Traits\Clauses\Limit;
use LazarusPhp\QueryBuilder\Traits\Clauses\Order;
use LazarusPhp\QueryBuilder\Traits\Clauses\Where;
use LazarusPhp\QueryBuilder\Traits\Controllers\Insert;
use LazarusPhp\QueryBuilder\Traits\Controllers\Select;
use LazarusPhp\QueryBuilder\Traits\Controllers\Update;
use LazarusPhp\QueryBuilder\Traits\Controllers\Delete;
use ReflectionClass;

class Core
{

    public $lastId;

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
    protected $param = [];
    protected $sql;
    protected $table;
    protected $query;

    protected  $dev;



    public $data = [];

    public function __set($name, $value)
    {
        $this->param[$name] = $value;
    }

    public function sql($sql,$params)
    {
        $this->sql = $sql;
        $this->param = $params;
        return $this->save($this->sql,$this->param);
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


    public function __construct(string $table = "")
    {
        empty($table) ? $this->generateTable() : $this->table = $table;
        // Instantiate a Blank $sql statement
        $this->sql = "";
    }

    protected function generateTable()
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
      
    $query = new QueryBuilder();
    $result = $query->save($this->sql, $this->param);

    // Get the last inserted ID if file is inserted
    $this->lastId = $query->lastId;

    return $result;

    }
    
        public function get($fetch = \PDO::FETCH_OBJ)
        {
            $query = $this->save();
            return $query->fetchAll($fetch);
        }

        public  function countRows()
        {
            return $this->save()->rowCount();
        }


        public function first($fetch = \PDO::FETCH_OBJ)
        {
            
            return $this->save()->fetch($fetch);
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
