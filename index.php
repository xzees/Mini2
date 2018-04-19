<?php

require_once __DIR__ . '/vendor/autoload.php';

use Core\Handle\HandleProvider;
use Core\Bootstrap;
use Core\Handle\RouteHandle;
use Core\Handle\SecureSessionHandle;
use Core\Provider\ConfigProvider;

HandleProvider::alias();
ConfigProvider::getInstance();
Bootstrap::getInstance();
Bootstrap::bootAll();
$routeBoot = new RouteHandle;
$routeBoot->bootstap();

session_save_path(__DIR__.'/storage/session');
$handler = new SecureSessionHandle();
session_set_save_handler(
    array($handler, 'open'),
    array($handler, 'close'),
    array($handler, 'read'),
    array($handler, 'write'),
    array($handler, 'destroy'),
    array($handler, 'gc')
);
register_shutdown_function('session_write_close');

