<!DOCTYPE html>
<html lang="ru" class="d-flex h-100 w-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профиль | H-chat</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="d-flex h-100 w-100">
    <div class="container card p-0 h-100 m-auto col-md-4">
        <img src="" class="card-img-top h-25 bg-primary" alt="...">
        <div class="card-body">
            <h5 class="card-title"><?php echo $_COOKIE['name']?></h5>
            <span class="d-flex justify-content-between">  
                <p class="card-text"><?php echo $_COOKIE['login']?></p>
                <p class="card-text"><?php echo $_COOKIE['role']?></p>
            </span>
            <a href="/chats" class="btn btn-primary mt-1">Чаты</a><br>
            <a href="/search" class="btn btn-primary mt-1">Новый собеседник</a><br>
            <a href="/group" class="btn btn-primary mt-1">Новая группа</a><br>
        </div>
    </div>
</body>
</html>