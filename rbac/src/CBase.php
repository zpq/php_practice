<?php
namespace rbac\src;

class CBase 
{
    protected $table;
    protected $property = array();

    public function __construct() {

    }

    public function __get($key) {
        if (isset($this->property[$key])) return $this->property[$key];
    }   

    public function __set($key, $value) {
        $this->property[$key] = $value;
    }

}