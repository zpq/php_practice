<?php
/**
 * Created by PhpStorm.
 * User: zpq
 * Date: 7/31/16
 * Time: 8:58 AM
 */

namespace ioc\source;
use ioc\source\B;
class A
{
    private $obj;

    public function __construct(B $b, $flag = true)
    {
        $this->obj = $b;
    }

    public function show() {
        $this->obj->show();
    }

}