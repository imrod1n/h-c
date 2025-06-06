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
    $result = $query->fetch(PDO::FETCH_ASSOC);
    $name = $result['name'];
    $id = $result['id'];
    $role = $result['role'];

    // Здесь должна быть проверка учетных данных, замените код ниже вашей проверкой!
    if ($query->rowCount() !== 0) { 
        setcookie('token', '', -1, '/');
        setcookie('name', '', -1, '/'); 
        setcookie('login', '', -1, '/');
        setcookie('role', '', -1, '/'); 
        if($result['ban'] == 0){
            // Если данные верны, создаем payload для токена
            $payload = array(
                'iss' => 'h-c.l',   // issuer
                'sub' => $login,       // subject (например, имя пользователя)
                'iat' => time(),          // issued at (текущее время)
                'exp' => time() + 3600 * 24    // expires in one day
            );

            // Генерируем JWT
            $token = JWT::encode($payload, $_ENV['JWT_SECRET'], 'HS256');

            setcookie("token", $token, time() + 3600 * 24, "/");
            setcookie("id", $id, time() + 3600 * 24, "/");
            setcookie("name", $name, time() + 3600 * 24, "/");
            setcookie("role", $role, time() + 3600 * 24, "/");
            setcookie("login", $login, time() + 3600 * 24, "/");

            header("Location: /");
        }else {
        http_response_code(401);
        header('Location: /error');
    }
    } else {
        http_response_code(401);
        header('Location: /error');
    }

?>