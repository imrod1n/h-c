<?php
    require "server/helpers/database.php";

    $user = $_GET['user'];

    $sql = 'SELECT * FROM users WHERE login = ?';
    $query = $conn->prepare($sql);
    $query->execute([$user]);

    $result = $query->fetch(PDO::FETCH_ASSOC);

    if($result['role'] == 'admin'){
        $adm = 'UPDATE `users` SET `role` = ? WHERE `users`.`login` = ?;';
        $query = $conn->prepare($adm);
        $query->execute(['user', $user]);
    }
    if($result['role'] == 'user'){
        $adm = 'UPDATE `users` SET `role` = ? WHERE `users`.`login` = ?;';
        $query = $conn->prepare($adm);
        $query->execute(['admin', $user]);
    }
    header("Location: /search");
?>