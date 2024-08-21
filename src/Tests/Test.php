<?php
namespace LazarusPhp\Orm\Tests;

class Test
{
    public function __construct()
    {
    }

    public function hello($username=null)
    {   $username = $username ?? "User";
        echo "Hello world : $username";
    }
}