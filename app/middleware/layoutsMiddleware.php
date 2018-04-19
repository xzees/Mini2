<?php

namespace Middleware;



class layoutsMiddleware 
{
  
    public static function handle($app)
    {
         $app->service()->layout(__DIR__ .'/../../views/layouts/app.phtml');
    }
}