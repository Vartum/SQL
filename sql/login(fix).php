<?php
try {
    $pdo = new PDO(
        'pgsql:host=db;dbname=vuln_db;port=5432',
        //↑ Параметры подключения
        //(СУБД - PostgreSQL: имя сервиса; имя БД;
        //стандартный порт для PostgreSQL)

        'postgres',
        //↑ По умолчанию для PostgreSQL

        'password',
        //↑ Значение из POSTGRES_PASSWORD

        [  
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            //↑ При любой ошибке (например, неверный SQL-запрос)
            //выбросит исключение PDOException, которое можно поймать в catch
            
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            //↑ Устанавливает формат возвращаемых данных при вызове методов вроде $stmt->fetch().
            //Данные возвращаются как ассоциативный массив, где ключи — это имена столбцов 
            //(например, ['username' => 'admin', 'password' => 'secret123']).
            //Удобно для чтения данных по именам столбцов

            PDO::ATTR_EMULATE_PREPARES => false
            //NEW ↑ Настройка PDO::ATTR_EMULATE_PREPARES => false усиливает безопасность, 
            //так как запросы обрабатываются на уровне PostgreSQL, а не эмулируются PHP.
        ]
    );
} catch (PDOException $e) {                             //← Отладка 
    die("Ошибка подключения к БД: " . $e->getMessage());//← Возвращение текста ошибки от PostgreSQL
}

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
                                //↖ Данные отпрпавленные методом POST, через index.php

//NEW ↓ Исправление уязвимости!!!
$sql = "SELECT * FROM users WHERE username = :username AND password = :password";
$stmt = $pdo->prepare($sql); //← prepare(): Подготавливает запрос на стороне PostgreSQL.
$stmt->execute(['username' => $username, 'password' => $password]);//← execute(): Безопасно передаёт параметры, 
                                                                            //исключая возможность инъекции
$user = $stmt->fetch();

// Административная панель с флагом
if ($user) {
    echo "<h1>FIX";
    echo "<h1>Добро пожаловать, " . htmlspecialchars($user['username']) . "!</h1>";
    if ($user['username'] === 'admin') {
        echo "<p>Вы успешно зашли от админа! А теперь зайдите от пользователя Vartum_05.";
    }
    if ($user['username'] === 'Vartum_05') {
        echo "<p>Поздравляю! Вот ваш флаг ↓";
        echo "<p>Флаг: <strong>zssoib{ඞ}</strong></p>";
    }
} else {
    echo "<h1>Ошибка входа!</h1>";
    echo "<p>Неверный логин или пароль.</p>";
    echo "<a href='index.php'>Назад</a>";
}
?>