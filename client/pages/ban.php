<?php
    require "server/helpers/database.php";

    $user = $_GET['user'];

    $sql = 'SELECT * FROM users WHERE login = ?';
    $query = $conn->prepare($sql);
    $query->execute([$user]);

    $result = $query->fetch(PDO::FETCH_ASSOC);

    if($result['ban'] == 0){
        $ban = 'UPDATE `users` SET `ban` = ? WHERE `users`.`login` = ?;';
        $query = $conn->prepare($ban);
        $query->execute([1, $user]);
    }
    if($result['ban'] == 1){
        $ban = 'UPDATE `users` SET `ban` = ? WHERE `users`.`login` = ?;';
        $query = $conn->prepare($ban);
        $query->execute([0, $user]);
    }
    header("Location: /search");
?>