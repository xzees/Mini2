<?php 

namespace Core\Handle;
use Base;
use DI\ContainerBuilder;

class RouteHandle
{
    public static $route;
    public static $config;
    public $request;
    public $response;
    public $service;
    public $app;
    public $container;
    public function __construct()
    {
        self::$route = new \Klein\Klein();
        self::$config = require dirname(dirname(__DIR__)) .'/config/config.php';
    }

    public function bootstap()
    {
        $containerBuilder = new ContainerBuilder;
        $containerBuilder->addDefinitions(dirname(dirname(__DIR__)) . '/config/di.php');
        $this->container = $containerBuilder->build();
        $rte =  require dirname(dirname(__DIR__)) .'/route/web.php';
        $base = Base::folder();
        $this->errorRoute();
        $this->service();
        $route = self::$route;
        $_this = $this;
        foreach($rte[''.$base] as $k=>$v)
        {    
            self::$route->respond($v['method'],$base.''.$v['path'],function ($request, $response, $service, $app) use ($v,$route,$_this) {
                $_this->middlewareRoute($v,$route,$app);
                $fuc = explode('@',$v['controller']);
                $objController = new $fuc[0]($request, $response, $service, $app);
                return $_this->container->call(
                    array($objController, $fuc[1])
                );
            });
        }
        $this->outPut();
    }

    public function errorRoute()
    {
        ## error 
        self::$route->onHttpError(function ($code, $router) {
            if(Base::isAjax()){
                if ($code >= 400 && $code < 500) {
                    $router->response()->json(array('message'=>'404 ERROR'));
                    
                } elseif ($code >= 500 && $code <= 599) {
                    $router->response()->json(array('message'=>'500 ERROR'));
                }
            }else{
                if ($code >= 400 && $code < 500) {
                    $router->service()->render( dirname(dirname(__DIR__)) .'/views/error/404.phtml');
                } elseif ($code >= 500 && $code <= 599) {
                    $router->service()->render( dirname(dirname(__DIR__)) .'/views/error/500.phtml');
                }
            }
        });
    }

    public function service()
    {
        ## service 
        self::$route->respond(function ($request, $response, $service, $app){
            require dirname(dirname(__DIR__)) .'/app/service/service.php';
        });
    }

    public function middlewareRoute($arr,$route,$app)
    {
        if(isset($arr['middleware'])){
            if(is_array($arr['middleware'])){
                $i=1;
                foreach($arr['middleware'] as $ks=>$vs){
                    $app->register($ks, function() use ($vs,$route){
                        return call_user_func(
                            array(
                                $vs,
                                'handle'
                            ),
                            $route
                        );
                    });
                }
            }else{
                $app->register('middleware', function() use ($arr,$route){
                    return call_user_func(
                        array(
                            $arr['middleware'],
                            'handle'
                        ),
                        $route
                    );
                });
            }
        }
        
        if(isset($arr['middleware'])){
            if(is_array($arr['middleware'])){
                foreach($arr['middleware'] as $ks=>$vs){
                    $app->$ks;
                }
            }else{
                $app->middleware;
            }
        }
    }
    public function outPut()
    {
        self::$route->dispatch();        
    }
}