<?php

namespace Core;

class SingletonProvider
{
    protected static $instance;
    final public static function getInstance()
    {

        return isset(static::$instance)
            ? static::$instance
            : static::$instance = new static;
    }
    
    protected function init() {}
    final private function __wakeup() {}
    final private function __clone() {}
}

