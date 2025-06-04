<?php
require "server/router.php";

$url = key(array: $_GET);

$router = new Router();

$router->addRoute("/reg", "reg.html");
$router->addRoute("/auth", "auth.html");
$router->addRoute("/error", "error.html");
$router->addRoute("/profile", "profile.php");
$router->addRoute("/", "/profile.php");
$router->addRoute("/search", "/search.php");
$router->addRoute("/ban", "/ban.php");
$router->addRoute("/admin", "/admin.php");
$router->addRoute("/chat", "/chat.php");

if($url == ""){
    require "server/checkToken.php";
    if($valid == true){
        $router->route("/profile");
    }else{
        $router->route("/auth");
    }
}else{
    $router->route('/'.$url);
}
?>