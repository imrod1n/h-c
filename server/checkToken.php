<?php
require_once __DIR__ . '../../vendor/autoload.php';
use Firebase\JWT\JWT;

// секретная фраза (та же самая, что и при создании токена!)
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$valid;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (!isset($_COOKIE['token'])) {
        http_response_code(401); // Unauthorized
        $valid = false;
        die();
    }

    $token = $_COOKIE['token'];

    try {
        $decoded = JWT::decode($token, $_ENV['JWT_SECRET']); // алгоритм подписи HS256
        
        echo json_encode([
            'message' => 'Token is valid!',
            'data' => $decoded
        ]);
        $valid = true;
    } catch (\Exception $e) {
        http_response_code(401); // Unauthorized
        $valid = false;
    }
}
?>