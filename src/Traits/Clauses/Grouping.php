<?php
namespace LazarusPhp\Orm\Traits\Clauses;

trait Grouping
{
    private $group = [];
    public function groupBy(...$columns)
    {
    // Add the column directly to the group array.
        foreach ($columns as $column)
        {
            $this->group[] = $column;
        }
    return $this;
    }

    public function fetchGroupBy()
    {
        if (!empty($this->group)) {
            // Ensure the GROUP BY clause is added to the SQL query
            $this->sql .= " GROUP BY " . implode(", ", $this->group);
        }
    }

}
