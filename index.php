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
$router->addRoute("/logout", "/logout.php");
$router->addRoute("/newGroup", "/newGroup.html");
$router->addRoute("/group", "/groupChat.php");
$router->addRoute("/chats", "/chats.php");

if($url == "" or $url == "chat" or $url == "profile"){
    require "server/checkToken.php";
    if($valid == true){
        $router->route('/'.$url);
    }else{
        $router->route("/auth");
    }
}else{
    $router->route('/'.$url);
}
?>