<?php
/**
 * Created by PhpStorm.
 * User: zpq
 * Date: 7/31/16
 * Time: 8:59 AM
 */

require '../vendor/autoload.php';
use ioc\Container;

class Test {

    private $c;

    public function __construct(Container $c)
    {
        $this->c = $c;
    }

    public function testClosure() {
        $this->c->bind('a', function() {
            return new ioc\source\A(new ioc\source\B(new ioc\source\C));
        });
        $a = $this->c->make('a');
        $a->show();
    }

    public function testNonClosure() {
        $this->c->bind('a', 'ioc\source\A');
        $a = $this->c->make('a');
        $a->show();
    }

    public function testNonSinleton() {
        $this->c->bind('a', 'ioc\source\A');
        $a1 = $this->c->make('a');
        $a2 = $this->c->make('a');
        var_dump($a1 === $a2);
    }

    public function testSinleton() {
        $this->c->bindSinleton('a', 'ioc\source\A');
        $a1 = $this->c->make('a');
        $a2 = $this->c->make('a');
        var_dump($a1 === $a2);
    }

    public function testRefreshSinleton() {
        $this->c->bindSinleton('a', 'ioc\source\A');
        $a1 = $this->c->make('a');
        $a2 = $this->c->make('a', true);
        var_dump($a1 === $a2);
    }

}

$t = new Test(new Container);

$t->testClosure();

$t->testNonClosure();

$t->testNonSinleton();

$t->testSinleton();

$t->testRefreshSinleton();









