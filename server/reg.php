<?php

$login = trim($_POST['login']);
$name = trim($_POST['name']);
$password = md5("bluiorbd893heh7v".trim($_POST['password']));



require "helpers/database.php";
$reg = 'INSERT INTO users(login, name, password, role) VALUES(?, ?, ?, ?)';
$query = $conn->prepare($reg);
$query->execute([$login, $name, $password, "user"]);

header("Location: /auth");
?>