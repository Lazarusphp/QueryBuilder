<?php
namespace LazarusPhp\Orm\Interfaces;

interface OrmInterface
{

    // Set the Crud Mandatory Sections
        public function table($table,$callable);
        public function select($alias);
        public function insert();
        public function update();
        public function delete();

}