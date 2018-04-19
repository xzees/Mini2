<?php

namespace Core\Handle;

class MiddlewarerHandle
{
    public $request;
    public $response;
    public $service;
    public $app;

    public function __construct($request, $response, $service, $app)
    {
        $this->request = $request;
        $this->response = $response;
        $this->service = $service;
        $this->app = $app;
    }
    
}