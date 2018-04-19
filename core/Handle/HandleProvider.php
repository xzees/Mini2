<?php 

namespace Core\Handle;

class HandleProvider
{
    private static $alias;
   
    public static function alias()
    {
        self::$alias = require dirname(__DIR__).'/Alias.php';
        self::callAlias(self::$alias);
    }
    
    public static function callAlias($data)
    {
        foreach($data as $k=>$v)
        {
            class_alias($v,$k);
        }
    }
}