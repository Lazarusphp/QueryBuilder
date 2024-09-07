<?php
namespace LazarusPhp\Orm\Traits\Conditions;

trait Grouping
{
    private $group = [];

    public function groupBy($column)
    {
    // Add the column directly to the group array.
    $this->group[] = $column;
    return $this;
    }

    public function fetchGroupBy()
    {
        if (!empty($this->group) && count($this->group)===1) {
        // Ensure the GROUP BY clause is added to the SQL query
        $this->sql .= " GROUP BY " . implode(", ", $this->group);
        }
    }

}
