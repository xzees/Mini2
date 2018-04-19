<?php 

namespace Core\Handle;

use Core\SingletonProvider; 
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

use DB;

class DatabaseHandle 
{
    protected static $instance;
    public static function getInstance()
    {
        return isset(static::$instance)
            ? static::$instance
            : static::$instance = new static;
    }
   
    private static $config;
    
    public function __construct()
    {
        self::$config = require dirname(dirname(__DIR__)) .'/config/database.php';
    }
    
    public static function boot()
    {
        $capsule = new DB;
        foreach(self::$config as $k=>$v){
            $capsule->addConnection($v,$k);  
        }
        
        $capsule->setEventDispatcher(new Dispatcher(new Container));

        $capsule->setAsGlobal();
        $capsule->bootEloquent();
        $events = new Dispatcher;
        $events->listen('illuminate.query', function($query, $bindings, $time, $name)
        {
            // Format binding data for sql insertion
            foreach ($bindings as $i => $binding) {
                if ($binding instanceof \DateTime) {
                    $bindings[$i] = $binding->format('\'Y-m-d H:i:s\'');
                } else if (is_string($binding)) {
                    $bindings[$i] = "'$binding'";
                }
            }

            // Insert bindings into query
            $query = str_replace(array('%', '?'), array('%%', '%s'), $query);
            $query = vsprintf($query, $bindings);

            // Debug SQL queries
            $_SESSION['sql'][] = $query;
            $_SESSION['sqlTime'][] = $time;
        });

        $capsule->setEventDispatcher($events);
        try {
            foreach(self::$config as $k=>$v){
                DB::connection($k)->getPdo() ;
            }
        } catch (\Exception $e) {
            
            echo ("Could not connect to the database.  Please check your configuration.");
        }
        
        
    } 
}