<?php

namespace Lazarusphp\Orm;

use LazarusPhp\DatabaseManager\Database;
use LazarusPhp\Orm\Interfaces\OrmInterface;
use LazarusPhp\Orm\Traits\Conditions\Where;
use LazarusPhp\Orm\Traits\Controllers\Insert;
use LazarusPhp\Orm\Traits\Controllers\Select;
use LazarusPhp\Orm\Traits\Controllers\Update;
use LazarusPhp\Orm\Traits\Controllers\Delete;
use ReflectionClass;

class OrmCore extends Database implements OrmInterface
{

    // Load Trait Files;
    use Insert;
    use Select;
    use Update;
    use Delete;
    // Load condition Traits
    use Where;
    // Generate the Param Values
    public $param = [];
    public $sql;
    public $table;
    private $flags = [];
    private $values;


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
        $this->GenerateTable();
        // Instantiate a Blank $sql statement
        $this->sql = "";
    }

    public function GenerateTable()
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



    private function newFlag($name, $value = true)
    {
        if (!isset($this->flags[$name])) {
            $this->flags[$name] = $value;
        } else {
            trigger_error("Flag $name Already Created");
        }
    }
    
    private function displayFlag($name)
    {
        if (array_key_exists($name, $this->flags)) {
            return true;
        } else {
            return false;
            trigger_error("Flag Doesnt Exist");
        }
    }

    public function save()
    {
        if ($this->displayFlag("select")) {
            // echo "select is chosen";
            // $this->Fetchwhere();
        } elseif ($this->displayFlag("insert")) {
            echo "insert Chosen";
         
        } elseif ($this->displayFlag("update")) {
            echo "update";
            $this->setValues();
            echo $this->sql;
        } elseif ($this->displayFlag("delete")) {
            echo "delete";
        }

        // Push Content
        $this->fetchWhere();
        $save = $this->GenerateQuery($this->sql,$this->param);
        if($save)
        {
            return $save;
        }
        else
        {
            echo "Failed to Save";
        }
    }
    public function hasQuery()
    {
        return $this->GenerateQuery($this->sql, $this->param=null);
    }

    // Get All
    public function get()
    {
       $this->FetchWhere();
        return $this->hasQuery()->fetchAll();
    }

    // Fetch a Single Record by id

    public function first()
    {
        if ($this->displayFlag("select")) {
            $this->FetchWhere();
            $query = $this->GenerateQuery($this->sql, $this->param);
            return $query->fetch();
        }
    }

}
