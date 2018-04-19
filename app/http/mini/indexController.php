<?php

namespace Controller\mini;

use Request;

class indexController extends \Controllers
{
    public function index()
    {   
        $arr = array(
            'csrf'=> $this->app->csrf
        );
        return $this->render('mini/index',$arr);
    }
    public function post(Request $request)
    {   
        dump($request->all());
        exit();
    }
    public function get()
    {   
        dump($this->request->id);
        exit();
    }
}