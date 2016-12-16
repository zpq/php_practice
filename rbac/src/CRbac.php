<?php
namespace rbac\src;

class CRbac
{

    public function checkAccess($role, $item) {
        //check whether the role has the auth of the item or not
        $where = ['and' => ['role_id' => $role, 'item_id' => $item]];
        $res = CDb::getIns()->select("role_item", '*', json_encode($where));
        return $res === false ? false : count($res) > 0;
    }

}