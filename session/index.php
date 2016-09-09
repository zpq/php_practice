<?php

require "./sessionDb.php";
session_start();
echo session_id()."<br>";
// session_destroy();
unset($_SESSION['age']);
if (count($_SESSION)) {
    var_dump($_SESSION);
} else {
    $_SESSION['username']  = "jack";
    $_SESSION['age']  = 100;
}

