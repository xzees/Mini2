<?php

return array(

    '/mini'=>array(
        'mini_dashboad'=> array(
            'path'=>'/',
            'method'=>'GET',
            'controller'=>'Controller\mini\indexController@index',
            'middleware'=> array(
                'session'   =>'Middleware\sessionMiddleware',
                'layout'    =>'Middleware\layoutsMiddleware'
            )
        ),
        'mini_post'=> array(
            'path'=>'/',
            'method'=>'POST',
            'controller'=>'Controller\mini\indexController@post',
            'middleware'=> array(
                'session'   =>'Middleware\sessionMiddleware',
                'secure'    =>'Middleware\csrfMiddleware',
            )
        ),
        'mini_get'=> array(
            'path'=>'/[:id]',
            'method'=>'GET',
            'controller'=>'Controller\mini\indexController@get',
            'middleware'=> array(
                'session'   =>'Middleware\sessionMiddleware',
                //'secure'    =>'Middleware\csrfMiddleware',
            )
        )

    )
    
);