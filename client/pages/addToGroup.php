<!DOCTYPE html>
<html lang="ru" class="d-flex h-100 w-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="d-flex h-100 w-100">
    <div class="container m-auto col-md-4 h-100">
        <?php           
            require "server/helpers/database.php";

            $sql = 'SELECT * FROM chats JOIN chat_members WHERE chat_members.user_id = ? AND chats.id = chat_members.chat_id';
            $query = $conn->prepare($sql);
            $query->execute([$_COOKIE['id']]);

            $result = $query->fetchAll(PDO::FETCH_ASSOC);

            foreach($result as $chat){
                echo'
            <div class="container card p-0 m-1">
                <div class="card-body d-flex justify-content-between">
                    <h5 class="card-title mt-auto">' . $chat['name'] . '</h5>
                    <button class="btn btn-lg btn-primary" type="submit">Добавить</button>
                </div>
            </div>
                ';
            }
            ?>

    </div>
</body>
</html>