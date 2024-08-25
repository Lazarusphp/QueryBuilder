<?php

namespace Lazarusphp\Orm;

use LazarusPhp\DatabaseManager\Database;
use LazarusPhp\Orm\Interfaces\OrmInterface;
use LazarusPhp\Orm\Traits\Select;

class Orm extends Database implements OrmInterface
{

    // Load Trait Files;
    // Generate the Param Values
    public $param = [];
    public $sql;
    public $table;
    private $flags = [];


    //Use Traits
    use Select;
    public function __construct()
    {
        Parent::__construct();
        // Instantiate a Blank $sql statement
        $this->sql = "";
    }


    public function table($table,$callable=null)
    {
        $this->table = $table;
        if(!is_null($callable) && is_callable($callable))
        {
            return $callable($this);
        }
        else
        {
            return $this;
        }
    }

    public function bind($key, $value)
    {
        $this->param[$key] = $value;
        return $this;
    }

    public function insert()
    {

    }

    public function update()
    {

    }

    public function delete()
    {

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
        if(array_key_exists($name,$this->flags))
        {
            return true;
        }
        else
        {
            trigger_error("Flag Doesnt Exist");
        }
    }

    public function generateUid($name)
    {
        // generate Param Name;
        return uniqid($name . "_");
    }

    public function sqlLoader()
    {
        if($this->displayFlag("select"))
        {
            // Select Loader
        }
        return $this;
    }

    // Get All
    public function get()
    {
        $this->sql($this->sql, $this->param);
        $this->All();
    }

    // Get 1
    public function first()
    {
        $this->sql($this->sql, $this->param);
        $this->One();
    }

    public function toJson($print = false)
    {
        ($print == true) ? header('Content-Type: application/json; charset=utf-8') : false;
        return json_encode($this->param);
    }
}
