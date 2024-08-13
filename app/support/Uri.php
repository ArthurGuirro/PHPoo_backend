<?php 
namespace app\support;

class Uri
{
    public static function get()
    {
        /*
        $requestUri = $_SERVER['REQUEST_URI'];
        $parsedUrl = parse_url($requestUri, PHP_URL_PATH);
        $path = trim($parsedUrl);
        return $path;
        */

        return trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
            
    }

}

?>