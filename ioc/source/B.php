<?php
/**
 * Created by PhpStorm.
 * User: zpq
 * Date: 7/31/16
 * Time: 8:58 AM
 */

namespace ioc\source;
use ioc\source\C;

class B
{
    private $obj;

    public function __construct(C $c, $flag = false)
    {
        $this->obj = $c;
    }

    public function show() {
        $this->obj->show();
    }
}