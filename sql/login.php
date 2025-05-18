<?php
//(Обработчик входа с SQL уязвимостью)
$host = 'sql-db-1';        // Имя контейнера MySQL из docker-compose.yml
$db = 'vuln_db';           // Название базы данных
$user = 'root';       // Пользователь БД
$pass = 'password';   // Пароль (должен совпадать с MYSQL_ROOT_PASSWORD)
$charset = 'utf8';    // Стандарт кодирования символов
echo $user;
//Настройка PDO (PHP Data Objects)
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //Ошибки будут выбрасывать исключения (удобно для отладки)
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       //Результаты запросов возвращаются как ассоциативные массивы
    PDO::ATTR_EMULATE_PREPARES   => false,                  //отключает эмуляцию prepared statements (для безопасности)
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    
} catch (PDOException $e) {
    die("Ошибка подключения к БД: " . $e->getMessage());
}

// Получаем данные из формы
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// УЯЗВИМЫЙ ЗАПРОС (SQL-инъекция возможна!)
$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
$stmt = $pdo->query($sql);
$user = $stmt->fetch();

if ($user) {
    echo "<h1>Добро пожаловать, " . htmlspecialchars($user['username']) . "!</h1>";
    if ($user['username'] === 'admin') {
        echo "<p>Флаг: <strong>zssoib{admin_password_123}</strong></p>";
    }
} else {
    echo "<h1>Ошибка входа!</h1>";
    echo "<p>Неверный логин или пароль.</p>";
    echo "<a href='index.php'>Назад</a>";
}
?>