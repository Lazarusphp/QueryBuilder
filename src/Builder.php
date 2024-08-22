<?php
namespace LazarusPhp\Orm;
use LazarusPhp\DatabaseManager\Database;

class Builder extends Database
{
    public $data = [];
    
    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }
    
    public function __get($name)
    {
        if(array_key_exists($name,$this->data))
        {
            return $this->data[$name];
        }
    }
    
    public function __isset($name)
    {
        return isset($this->data[$name]);
    }
    
    public function __unset($name)
    {
        unset($this->data[$name]);
    }    
}