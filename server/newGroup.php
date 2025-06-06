<?php

$name = trim($_POST['name']);

require "helpers/database.php";

$reg = 'INSERT INTO chats(name, type) VALUES( ?, ?)';
$query = $conn->prepare($reg);
$query->execute([$name, "grp"]);

$reg = 'SELECT id FROM chats WHERE name = ? ORDER BY id DESC LIMIT 1';
$query = $conn->prepare($reg);
$query->execute([$name]);

$result = $query->fetch(PDO::FETCH_ASSOC);
$chat_id = $result['id'];

$reg = 'INSERT INTO chat_members(user_id, chat_id) VALUES(?, ?)';
$query = $conn->prepare($reg);
$query->execute([$_COOKIE['id'], $chat_id]);

header("Location: /group?name=".$chat_id);
?>