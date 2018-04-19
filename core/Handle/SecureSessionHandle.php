<?php


namespace Core\Handle;

use Config;

class SecureSessionHandle
{
    private $savePath;
    private $sessionTime;
    private static $config;

    public function __construct()
    {
        self::$config = Config::getConfig();   
        if(!$_COOKIE['Alias']) {
            if(self::$config['sessionTime']==null) {
                $time = time() + (2628000 * 60);
            }else{
                $time = self::$config['sessionTime'];
            }

            $token = substr(md5(mt_rand()), 0, 13);
            @setcookie('Alias', $token, $time, '/');
        }
    }

    function open($savePath, $sessionName)
    {
        $this->savePath = $savePath;
        if (!is_dir($this->savePath)) {
            mkdir($this->savePath, 0777);
        }
        return true;
    }

    function close()
    {
        return true;
    }

    function read($id)
    {
        return (string)@file_get_contents("$this->savePath/sess_".$_COOKIE['Alias']);
    }

    function write($id, $data)
    {
        return file_put_contents($this->savePath."/sess_".$_COOKIE['Alias'], $data) === false ? false : true;
    }

    function destroy($id)
    {
        $file = "$this->savePath/sess_".$_COOKIE['Alias'];
        if (file_exists($file)) {
            unlink($file);
            $this->removeCookie('Alias');
        }

        return true;
    }

    function gc($maxlifetime)
    {
        foreach (glob("$this->savePath/sess_*") as $file) {
            if (filemtime($file) + $maxlifetime < time() && file_exists($file)) {
                unlink($file);
                $this->removeCookie('Alias');
            }
        }

        return true;
    }
    public function removeCookie($name)
    {
        unset($_COOKIE[$name]);
        setcookie($name, null, -1, '/');
    }
}