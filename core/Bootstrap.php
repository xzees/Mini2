<?php

namespace Core;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\ErrorHandler;
use Monolog\Formatter\JsonFormatter;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Handler\JsonResponseHandler;
use Log;
use Config;
use Core\Handle\DatabaseHandle;
use Base;

class Bootstrap
{

    protected static $instance;
    public static function getInstance()
    {
        return isset(static::$instance)
            ? static::$instance
            : static::$instance = new static;
    }
    
    public $config;

    public function __construct()
    {
        $this->config = Config::getConfig();
    }
   
    public function errorBoot()
    {
        error_reporting(E_ALL ^ E_NOTICE);
        if($this->config['error']==true){
            ini_set('display_errors', 1);
            $run     = new \Whoops\Run;
            $handler = new PrettyPageHandler;
            $handler->setPageTitle("Whoops! There was a problem.");
            $run->pushHandler($handler);
            if(Base::isAjax()){
                $run->pushHandler(new JsonResponseHandler);
            }
            $run->register(); 
        }
        if($this->config['error']==false){
            ini_set('display_errors', 0); 
        }
    }
    public function dateBoot()
    {
        ini_set('date.timezone', $this->config['date']);
    }

    public function logBoot()
    {
        $formatter = new JsonFormatter();
        $stream = new StreamHandler(dirname(__DIR__) . '/storage/logs/errors_'.date('Ymd').'.log');
        $stream->setFormatter($formatter);

        $securityLogger = new Logger('miniLog');
        ErrorHandler::register($securityLogger);
        $securityLogger->pushHandler($stream);
        
        Log::getInstance($securityLogger);
    }

    public static function bootAll()
    {
        $data = new self;
        $data->errorBoot();
        $data->dateBoot();
        $data->logBoot();
        DatabaseHandle::getInstance();
        DatabaseHandle::boot();
        
    }
    
}