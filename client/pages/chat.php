<!DOCTYPE html>
<html lang="ru" class="d-flex h-100 w-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="d-flex h-100 w-100">
    <div class="container mt-auto col-md-4 h-100 ">
    
    <div id="messages" class="h-100">
        <?php
            require "server/helpers/database.php";

            $sql = 'SELECT * FROM messages WHERE chat = ?';
            $query = $conn->prepare($sql);
            $query->execute([$_GET['name']]);

            $result = $query->fetchAll(PDO::FETCH_ASSOC);

            foreach($result as $message){
            if ($message['sender'] == $_COOKIE['login']){
                        echo '
                            <div class="bg-primary text-white p-3" style="width: fit-content; height: fit-content; margin-left: auto; border-radius:15px">
                                <h6 class="m-0 p-0">' . $message['content'] . '</h6>
                            </div>';}
           else{
                        echo '
                            <div class="bg-black text-white p-3" style="width: fit-content; height: fit-content; border-radius:15px">
                                <p  class="m-0 p-0">' . $message['sender'] . ':</p>
                                <h6 class="m-0 p-0">' . $message['content'] . '</h6>
                            </div>';}
            }?>
    </div>
        <form class="m-1 w-100 sticky-bottom fixed-bottom">
            <div class="form-floating d-flex">
                <input type="text" class="form-control" autocomplete="off">
                <button class="btn btn-lg btn-primary w-25" type="submit">-></button>
            </div>
        </form>
    </div>
    <script src="client/pages/script.js"></script>
</body>
</html>