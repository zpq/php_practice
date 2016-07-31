<?php
/**
 * Created by PhpStorm.
 * User: zpq
 * Date: 7/31/16
 * Time: 8:58 AM
 */

namespace ioc\source;

class C
{

    public function __construct()
    {

    }

    public function show() {
        echo 'I am class : ', __CLASS__, "\r\n";
    }
}