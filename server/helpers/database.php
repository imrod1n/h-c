<?php
$dbhost = '127.0.0.1';
$dbport = '3306';
$dbname = 'H-chat';
$dsn = "mysql:host={$dbhost};port={$dbport};dbname={$dbname}";
$dbusername = 'root';
$dbpassword = '';
$conn = new PDO($dsn, $dbusername, $dbpassword);
?>