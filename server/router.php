<?php

class Router
{
    private $pages = array();

    function addRoute($url, $path){
        $this->pages[$url] = $path;
    }

    function route($url){
        if(array_key_exists($url, $this->pages)){
            $path = $this->pages[$url];
            $path = $this->pages[$url];
            $file = "client/pages/".$path;        
        
            if (file_exists($file)){
                require $file;
            } 
            else{
                require "client/pages/404.html";
                die();
            }
        }
        else{
            require "client/pages/404.html";
            die();
        }
    }
}

?>