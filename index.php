<?php
require "server/router.php";
$valid = true;
require "server/checkToken.php";

$url = key($_GET);

$router = new Router();

$router->addRoute("/reg", "reg.html");
$router->addRoute("/auth", "auth.html");
$router->addRoute("/error", "error.html");
$router->addRoute("/profile", "profile.html");
$router->addRoute("/", "profile.html");

if($valid == false){
    $router->route("/auth");
}else{
    $router->route("/".$url);
}
?>