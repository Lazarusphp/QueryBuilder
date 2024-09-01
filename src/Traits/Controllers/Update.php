<?php
namespace LazarusPhp\Orm\Traits\Controllers;

trait Update
{
    protected $keyvalues = [];
    
    public function update()
    {
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
 


}