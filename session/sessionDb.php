<?php

class MySessionHandler implements SessionHandlerInterface
{
    private $db;
    function open($savePath, $sessionName) {
        echo "open session<br>";
        try {
            $this->db = new mysqli("localhost", "root", "123456", "test"); 
        } catch (Excetion $e) {
            die($e->getMessage());
        }
    }

    function close() {
        echo "session close<br>";
        $this->db->close();
    }

    function read($id) {
        echo "session read<br>";
        $expire_time = time() - ini_get("session.gc_maxlifetime");
        $result = $this->db->query("select session_datas from sessions where session_id = '" . $id .
        "' and update_time > " . $expire_time);
        if ($result && $row = ($result->fetch_assoc())) {
            return $row['session_datas'];
        } else {
            return '';
        }
    }

    function write($id, $datas) {
        echo "session write<br>";
        $expire_time = time() - ini_get("session.gc_maxlifetime");
        $result = $this->db->query("insert into sessions values('". $id . "','" . $datas . "'," . time(). ")");
        if ($result) {
            return true;
        } else {
            $result = $this->db->query("update sessions set datas = " . $datas . " and update_time = " . time() . " where update_time > " . $expire_time);
            if ($result) {
                return true;
            }
            return false;
        }
    }

    function destroy($id) {
        echo "session destroy<br>";
        $result = $this->db->query("delete from sessions where session_id = '" . $id . "'");
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    function gc($maxlifetime) {
        $result = $this->db->query("delete from sessions where update_time < " . (time() - $maxlifetime));
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}


$handler = new MySessionHandler;
session_set_save_handler($handler, true);
