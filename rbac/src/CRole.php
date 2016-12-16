<?php
namespace rbac\src;

class CRole extends CBase
{
    const ADMIN_TYPE = 0;

    public function __construct() {
        $this->table = "role";
    }

    public function addRole($role) {
        return CDb::getIns()->create($this->table, json_encode($role));
    }

    public function deleteRole($role) {
        return CDb::getIns()->delete(json_encode($role));
    }

    public function freezeRole($role) {

    }

    public function isAdmin($role) {

    }

    public function attachRoleForUser($role, $user) {
        return CDb::getIns()->create("role_user", json_encode(array('role_id' => $role, 'user_id' => $user)));
    }

    public function detachRoleForUser($role, $user) {
        if (is_array($role)) { //mutli roles

        } else {

        }
    }

}