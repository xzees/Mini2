<?php 

## register in folder mini
$merged = array_replace_recursive(
    require 'mini.php'
);

## register outsize mini
$data = array_merge(
    array() //file 
);

$route_arr =  array_merge(
    $data,
    $merged
);

return $route_arr;