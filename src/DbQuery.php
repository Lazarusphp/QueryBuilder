<?php

namespace LazarusPhp\QueryBuilder;

use Lazarusphp\QueryBuilder\Core;

class DbQuery
{

    public static function table($table)
    {
         return new Core($table);
    }
}