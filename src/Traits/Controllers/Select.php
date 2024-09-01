<?php
namespace LazarusPhp\Orm\Traits\Controllers;


trait Select
{
    protected $args;
    public function select(...$args)
    {      
  
            (count($args) > 0) ? $this->args = implode(",",$args) : $this->args = "*";
            $this->sql .= "SELECT $this->args FROM " . $this->table;
            return $this;
    }


    public function findById($id)
    {
      $query = $this->select()->where("id",$id)->save();
      if($query->rowCount() === 1)
      {
        return $query->fetch();
      }
      else
      {
        return false;
      }
    }

    /**
     * Find or failed
     *
     * @param [int] $id
     * select value based on the user id;
     * return true or false; does not pass any values
     * cal
     * @return void
     */
    public function findOrFail(int $id):bool
    {
          $query = $this->select()->where("id",$id)->save();
          if($query->rowCount() === 1)
          {
                return true;
          } 
          else
          {
            return false;
          }
    }

    public function as($alias)
    {
        $this->sql .= " AS $alias ";
        return $this;
    }


}