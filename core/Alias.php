<?php

/**
 *
 *  alias is change name class to use
 *
 */

return array(
    'Base'          =>  'Core\Provider\BaseProvider',
    'DB'            =>  'Illuminate\Database\Capsule\Manager',
    'Controllers'   =>  'Core\Handle\ControllerHandle',
    'Middlewares'   =>  'Core\Handle\MiddlewarerHandle',
    'Bootstrap'     =>  'Core\Bootstrap',
    'Log'           =>  'Core\Provider\LogProvider',
    'Config'        =>  'Core\Provider\ConfigProvider',
    'Mail'          =>  'Core\Provider\MailProvider',
    'Pdf'           =>  'Core\Provider\PdfProvider',
    'Excel'         =>  'Core\Provider\ExcelProvider',
    'Helper'        =>  'Core\Provider\Helper',
    'Request'       =>  'Illuminate\Http\Request'
);