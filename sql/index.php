<! В head просто настрока стилей  
   В body разметка надписи "Вход в систему" и строки логина и пароля
   18 строка←Отправление данных в login.php через метод POST>
<!DOCTYPE html>  
<html>
<head>
    <title> (●'◡'●) SQL Injection Challenge | Вход </title>
    <style>
        body { font-family: system-ui; }  
        .login-form { width: 250px; margin: 15em auto; }
        input { width: 100%; padding: 5px; margin: 5px 0; }
        button { background:rgb(0, 0, 0); color: whitesmoke; padding: 5px; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <div class="login-form">
        <h2> Вход в систему </h2>
        <form method="POST" action="login.php">
            <input type="text" name="username" placeholder="Логин" required><br>
            <input type="password" name="password" placeholder="Пароль" required><br>
            <button type="submit"> Тык </button>
        </form>
    </div>  
</body>
</html>