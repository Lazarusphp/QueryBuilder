<?php
namespace LazarusPhp\Orm\Interfaces;

interface OrmInterface
{

    // Set the Crud Mandatory Sections
        public function table();
        public function select(array ...$args);
        public function insert();
        public function update();
        public function delete();

}