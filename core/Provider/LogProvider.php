<?php 

namespace Core\Provider;

class LogProvider 
{
    protected static $instance;
    public static function getInstance($log)
    {
        return isset(static::$instance)
            ? static::$instance
            : static::$instance = new static($log);
    }
    public static $log;
    
    public function __construct($log)
    {
        self::$log = $log;
    }

    public static function info($msg)
    {
        
        self::$log->info($msg);
    }
    public static function warning($msg)
    {
        
        self::$log->warning($msg);
    }
    public static function error($msg)
    {
        
        self::$log->error($msg);
    }

    
}