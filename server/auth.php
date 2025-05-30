<?php
require_once __DIR__ . '../../vendor/autoload.php';
use Firebase\JWT\JWT;

// Загружаем переменные окружения
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

    // Данные формы
    $login = trim($_POST['login']);
    $password = md5("bluiorbd893heh7v".trim($_POST['password']));

    require "helpers/database.php";

    $sql = 'SELECT * FROM users WHERE login = ? AND password = ?';
    $query = $conn->prepare($sql);
    $query->execute([$login, $password]);
    
    // Здесь должна быть проверка учетных данных, замените код ниже вашей проверкой!
    if ($query->rowCount() !== 0) {  
        // Если данные верны, создаем payload для токена
        $payload = array(
            'iss' => 'example.com',   // issuer
            'sub' => $login,       // subject (например, имя пользователя)
            'iat' => time(),          // issued at (текущее время)
            'exp' => time() + 3600 * 24    // expires in one day
        );
        
        // Генерируем JWT
        $token = JWT::encode($payload, $_ENV['JWT_SECRET'], 'HS256');
        
        setcookie("token", $token, time() + 3600 * 24, "/");


        header("Location: /");

    } else {
        http_response_code(401);
        header('Location: /error');
    }

?>