<?php
$dbhost = 'h-chat.l';
$dbport = '3306';
$dbname = 'H-chat';
$dsn = "mysql:host={$dbhost};port={$dbport};dbname={$dbname}";
$dbusername = 'root';
$dbpassword = '';
$conn = new PDO($dsn, $dbusername, $dbpassword);
?>