<?php

namespace Middleware;

class sessionMiddleware 
{
    public static function handle($app)
    {
         $app->service()->startSession();
        if (!$_SESSION['csrf_token']) 
        {
            $_SESSION['csrf_token'] = base64_encode(openssl_random_pseudo_bytes(32).''.time());
        }
    }
}