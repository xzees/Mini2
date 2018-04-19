<?php 

namespace Core\Provider;

class ConfigProvider  
{
    protected static $instance;
    private static $config;

    public static function getInstance()
    {
        return isset(static::$instance)
            ? static::$instance
            : static::$instance = new static;
    }

    public function __construct()
    {
        self::$config = require dirname(dirname(__DIR__)) .'/config/config.php';
    }

    public static function getConfig()
    {
        return self::$config;
    }    

    public static function getMail()
    {
        return require dirname(dirname(__DIR__)) .'/config/mail.php';
    }
    
}