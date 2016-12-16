<?php
namespace rbac\src;

class CItem extends CBase
{
    public function __construct() {
        $this->table = "item";
    }

    public function addItem($item) {
        return CDb::getIns()->create($this->table, json_encode($item));   
    }

    public function deleteItem($item) {
        return CDb::getIns()->delete($this->table, json_encode($item));
    }

    public function attachItemForRole($item, $role) {
        // add item(s) on role
        if (is_array($item)) { //mutli items
            $inserts = [];
            foreach($item as $im) {
                $inserts[] = array('role_id' => $role, 'item_id' => $im);
            }
            CDb::getIns()->create("role_item", json_encode($inserts));
        } else {
            CDb::getIns()->create("role_item", json_encode(array("role_id" => $role, "item_id" => $item)));
        }

    }

    public function detachItemForRole($item, $role) {
        // add item(s) on role
        if (is_array($item)) { //mutli items
            $deletes = [];
            foreach($item as $im) {
                $deletes[] = array('role_id' => $role, 'item_id' => $im);
            }
            CDb::getIns()->delete("role_item", json_encode($deletes));
        } else {

        }

    }

}