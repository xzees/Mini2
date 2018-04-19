<?php

namespace Core\Provider;



class BaseProvider
{
    public static function isAjax() {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }
    public static function base_path()
    {
        $remove_end_slash_arr = explode('/',$_SERVER['SCRIPT_NAME']);
        array_pop($remove_end_slash_arr);
        $remove_end_slash = implode('/',$remove_end_slash_arr);
        $base_url = $remove_end_slash;
        $base = $base_url;
        return $base;
    }
    public static function folder()
    {
        $remove_end_slash_arr = explode('/',$_SERVER['SCRIPT_NAME']);
        array_pop($remove_end_slash_arr);
        $remove_end_slash = implode('/',$remove_end_slash_arr);
        $base_url = $remove_end_slash;
        $base = $base_url;
        return $remove_end_slash;
    }
}