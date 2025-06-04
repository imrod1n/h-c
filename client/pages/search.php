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
        <form action="" method="POST" class="m-1 w-100">
            <h4 class="mb-0 fw-normal p-0">Введите логин или имя</h4>
            <div class="form-floating d-flex">
                <input type="text" class="form-control" placeholder="Name" name="search">
                <label for="floatingInput">Логин или имя</label>
                <button class="btn btn-lg btn-primary" type="submit">Найти</button>
            </div>
        </form>
        <?php

        if(!empty($_POST)){
            $search = $_POST['search'];
            
            require "server/helpers/database.php";

            $sql = 'SELECT * FROM users WHERE login = ? OR name = ?';
            $query = $conn->prepare($sql);
            $query->execute([$search, $search]);

            $result = $query->fetchAll(PDO::FETCH_ASSOC);

            foreach($result as $user){
            echo '
            <div class="container card p-0 m-1">
                <div class="card-body">
                    <h5 class="card-title">' . $user['name'] . '</h5>
                    <span class="d-flex justify-content-between">  
                        <p class="card-text">' . $user['login'] . '</p>
                        <p class="card-text">' . $user['role'] . '</p>
                    </span>
                    <a href="/chat?name=' . $user['login'] . '" class="btn btn-primary m-1">Написать</a>
                    ';
                    if ($_COOKIE['role'] == 'admin'){
                        echo'<a href="/ban?user=' . $user['login'] . '" class="btn btn-primary m-1">Бан</a>';
                        echo'<a href="/admin?user=' . $user['login'] . '" class="btn btn-primary m-1">Повысить</a>';
                    }
                    echo'
                </div>
            </div>';}}?>
    </div>
</body>
</html>