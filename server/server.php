<?php
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

require_once __DIR__ . '../../vendor/autoload.php';

class Chat implements MessageComponentInterface {
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
        
    }

    public function onOpen(ConnectionInterface $connt) {
        $this->clients->attach($connt);
        echo "Новое соединение: ({$connt->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
            $mseg = json_decode($msg, true);
            $cont = $mseg['content']; $send = $mseg['sender']; $chat = $mseg['chat']; 
            require "helpers/database.php";
            $stmt = $conn->prepare("INSERT INTO messages (content, sender, chat) VALUES (?,?,?)");
            $stmt->execute([$cont, $send, $chat]);
            
            // Логирование результата вставки
            echo "Сообщение успешно сохранено в базе данных.\n";
      foreach ($this->clients as $client) {
              $client->send($msg);
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