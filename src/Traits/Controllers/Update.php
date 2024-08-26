<?php
namespace LazarusPhp\Orm\Traits\Controllers;

trait Update
{
    protected $keyvalues = [];
    public function update()
    {
        $this->newFlag("update");
        $this->sql .= "UPDATE $this->table SET ";
        foreach($this->param as $key => $param)
        {
            $this->keyvalues[] = "$key=:$key";
        }
        $this->sql .= implode(",",$this->keyvalues);
        return $this;
    }

    public function setValues()
    {

        return $this->sql;
    }
 

    public function with($name,$value)
    {
        $param = uniqid("param_");
        $this->param[$name] = $value;
        return $this;
    }


}