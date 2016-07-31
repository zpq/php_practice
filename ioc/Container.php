<?php
/**
 * Created by PhpStorm.
 * User: zpq
 * Date: 7/31/16
 * Time: 8:53 AM
 */

namespace ioc;

/**
 * Class Container
 * A simple implementation of ioc
 * @package ioc
 */

class Container
{

    protected $enable_overwrite; //是否允许覆盖已绑定的

    protected $instances = [];

    protected $sinleton = [];

    protected $sinleton_instances = [];

    public function __construct($enable_overwrite = false)
    {
        $this->enable_overwrite = is_bool($enable_overwrite) ? $enable_overwrite : false;
    }


    public function bind($alias, $obj) {
        $this->_bind($alias, $obj);
    }

    //绑定单例
    public function bindSinleton($alias, $obj) {
        $this->_bind($alias, $obj, true);
    }

    protected function _bind($alias, $obj, $isSinleton = false) {
        if ($isSinleton) { //绑定单例
            if (in_array($alias, $this->sinleton)) {
                if ($this->enable_overwrite) {
                    $this->sinleton[] = $alias;
                    $this->instances[$alias] = $obj;
                }
            } else {
                $this->sinleton[] = $alias;
                $this->instances[$alias] = $obj;
            }
        } else {
            if (isset($this->instances[$alias])) {
                if ($this->enable_overwrite) {
                    if (in_array($alias, $this->sinleton)) { //单例中有, 则删除
                        $keys = array_keys($this->sinleton, $alias);
                        foreach($keys as $key) {
                            unset($this->sinleton[$key]);
                        }
                        unset($this->sinleton_instances[$alias]);
                    }
                    $this->instances[$alias] = $obj;
                }
            } else {
                $this->instances[$alias] = $obj;
            }
        }
    }

    //对外获取指定实例的接口
    public function make($alias, $sinleton_new = false)
    {
        if (!$sinleton_new) { //不强制获取新实例
            if (isset($this->sinleton_instances[$alias])) {
                return $this->sinleton_instances[$alias];
            }
        }

        $instance = isset($this->instances[$alias]) ? $this->instances[$alias] : null;
        if ($instance) {
            $obj = $this->resolveInstance($instance);
            if ($obj) {
                if (in_array($alias, $this->sinleton)) { //是否被注册为单例
                    $this->sinleton_instances[$alias] = $obj;
                }
            }
            return $obj;
        }
        return null;
    }

    //创建实例
    protected function resolveInstance($instance) {
        if ($instance) {
            if ($instance instanceof \Closure) {
                return $instance();
            } else {
                $r = new \ReflectionClass($instance);
                if (!$r->isInstantiable()) {
                    throw new \Exception("Invalid class : It is not instantiable!");
                }
                $construct = $r->getConstructor();
                if ($construct === null) {
                    throw new \Exception("Invalid class : It has no contructor!");
                }
                $params = $construct->getParameters();

                $args = $this->resolveDependencies($params);

                return $r->newInstanceArgs($args);
            }
        } else {
            return null;
        }
    }

    //解析依赖
    protected function resolveDependencies($dp) {
        $dependencies = [];
        foreach ($dp as $v) {
            $class = $v->getClass(); //获取参数的type hint | function(Array $arr) => "Array"
            /*
            if ($class->inNamespace()) {
                $instance = $class->getNamespaceName() . $class->getName();
            } else {
                $instance = $class->getName();
            }
            */
            if ($class) {
                $dependencies[] = $this->resolveInstance($class->getName());
            } else { //是默认参数
                $dependencies[] = $this->resolveDefaultValueParam($v);
            }
        }
        return $dependencies;
    }

    protected function resolveDefaultValueParam($param) {
        if (!$param->isDefaultValueAvailable()) {
            throw new \Exception("unresolvable param");
        }
        return $param->getDefaultValue();
    }

}

