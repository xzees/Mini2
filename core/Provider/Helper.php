<?php 

namespace Core\Provider;

class Helper  
{
    public static function appendGet($url,$key,$value,$unset){
        if (stripos($url, "?") !== false) {
            $url = $url;
        }else{
            if(isset($_GET)){
                unset($_GET[$unset]);
                $GET = http_build_query($_GET);
                $url = $url.'?'.$GET;
            }
        }
        $a = parse_url($url);
        $query = $a['query'] ? $a['query'] : '';
        parse_str($query,$params);
        $params[$key] = $value;
        $query = http_build_query($params);
        $result = '';
        if(isset($a['scheme'])){
            $result .= $a['scheme'] . ':';
        }
        if(isset($a['host'])){
            $result .= '//' . $a['host'];
        }
        if(isset($a['path'])){
            $result .=  $a['path'];
        }
        if($query){
            $result .=  '?' . $query;
        }
        return $result;
    }

    
}