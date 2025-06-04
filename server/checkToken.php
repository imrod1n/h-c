<?php
require_once __DIR__ . '../../vendor/autoload.php';
use Firebase\JWT\JWT;

// секретная фраза (та же самая, что и при создании токена!)
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$valid = true;
// Указать JWT для проверки.  
$secretKey = $_ENV['JWT_SECRET'];  
    
if(isset($_COOKIE["token"])){
    $jwt = $_COOKIE['token'];
    $valid=true;
}else{
    $valid=false;
}
// Токен валиден, вывести сообщение.  
?>