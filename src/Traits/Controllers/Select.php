<?php
namespace LazarusPhp\QueryBuilder\Traits\Controllers;


trait Select
{

    public function select(...$args)
    {
            (count($args) > 0) ? $args = implode(",",$args) : $args = "*";
            $this->sql .= "SELECT $args FROM " . $this->table;
            return $this;
    }


  

  public function findById($id)
  {
    $query = $this->select()->where("id", $id)->save();
    if ($query->rowCount() === 1) {
      return $query->fetch();
    } else {
      return false;
    }
  }

  public function union($table)
  {
      $this->table = $table;
      $this->sql .= " UNION ";
      return $this;
  }

    /**
     * Find or fail
     *
     * @param [int] $id
     * select value based on the user id;
     * return true or false; does not pass any values
     * cal
     * @return void
     */

  public function findOrFail(int $id): bool
  {
    $query = $this->select()->where("id", $id)->save();
    if ($query->rowCount() === 1) {
      return true;
    } else {
      return false;
    }
  }

    public function as($alias)
    {
        $this->sql .= " $alias ";
        return $this;
    }


}