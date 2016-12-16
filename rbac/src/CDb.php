<?php
namespace rbac\src;

class CDb 
{

    protected static $db = null;
    protected static $m = null;

    private function __construct() {
        $this->createDb();
    }

    private function __clone() {
        throw new \Exception("can not clone this!");
    }

    private function createDb() {
        self::$m = new \medoo([
            'database_type' => 'mysql',
            'database_name' => 'rbac',
            'server' => 'localhost',
            'username' => 'root',
            'password' => '123456',
            'charset' => 'utf8'
        ]);
    }

    public static function getIns() {
        if (self::$db instanceof self) {
            return self::$db;
        } else {
            return self::$db = new self;
        }
    }

    public function select($table, $field, $where) {
        if (is_array($field)) {
            $field = json_decode($field, true);
        }
        return self::$m->select($table, $field, json_decode($where, true));
    }

    public function create($table, $data) {
        return self::$m->insert($table, json_decode($data, true));
    }

    public function update($table, $data) {
        return self::$m->update($table, json_decode($data, true));
    }

    public function delete() {
        return self::$m->delete($table, json_decode($data, true));
    }

    public function queryAllBySql($sql) {
        return self::$m->quert($sql);
    }

}

