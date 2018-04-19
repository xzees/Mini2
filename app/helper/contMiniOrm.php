<?php 

/** 
 * 
 * Include File for use outside framework mini
 * 
 * 
*/

require_once dirname(dirname(__DIR__)) . '/vendor/autoload.php';

use Core\Handle\HandleProvider;
use Core\Bootstrap;
use Core\Provider\ConfigProvider;
use Core\Handle\DatabaseHandle;

HandleProvider::alias();
ConfigProvider::getInstance();
DatabaseHandle::getInstance();
DatabaseHandle::boot();