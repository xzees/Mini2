<?php

namespace Middleware;

class csrfMiddleware 
{
    public static function handle($app)
    {
        if (isset($_POST['csrf_token']) && ($_POST['csrf_token'] == $_SESSION['csrf_token'])) 
        {
            $_SESSION['csrf_token'] = base64_encode(openssl_random_pseudo_bytes(32).''.time());
            unset($_POST['csrf_token']);
        }else{
            $app->service()->flash('Token not find');
            $app->app()->back;

        }
    }
}