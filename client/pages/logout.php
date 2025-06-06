<?php
        setcookie('token', '', -1, '/');
        setcookie('name', '', -1, '/'); 
        setcookie('login', '', -1, '/');
        setcookie('role', '', -1, '/'); 

        header("Location: /auth")
?>