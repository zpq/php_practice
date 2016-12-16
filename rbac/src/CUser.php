<?php
namespace rbac\src;

class CUser extends CBase
{
    public function __construct() {
        $this->table = "user";
    }

    public function addUser($user) {
        return CDb::getIns()->create($this->table, json_encode($user));
    }
}