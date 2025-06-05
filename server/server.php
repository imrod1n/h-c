<?php
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

require_once __DIR__ . '../../vendor/autoload.php';
require "helpers/database.php";

class Chat implements MessageComponentInterface {
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $connt) {
        $this->clients->attach($connt);
        echo "Новое соединение: ({$connt->resourceId})\n";
        $connt->send("Введите ваше имя:");
    }

    public function onMessage(ConnectionInterface $from, $msg) {
      if (!isset($from->username)) {
          $from->username = $_COOKIE['name'];
          $from->send("Добро пожаловать, $msg!");
          return;
      }
  
      foreach ($this->clients as $client) {
          if ($client !== $from) {
              $client->send("{$from->username}: $msg");
          }
          else{
              $client->send("Вы: $msg");
          }
      }
  }

    public function onClose(ConnectionInterface $connt) {
        // Удаляем соединение из списка клиентов
        $this->clients->detach($connt);
        echo "Соединение закрыто: ({$connt->resourceId})\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "Ошибка: {$e->getMessage()}\n";
        $conn->close();
    }
}

// Запуск сервера на порту 8080
$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new Chat()
        )
    ),8080
);

echo "Сервер запущен на порту 8080\n";
$server->run();