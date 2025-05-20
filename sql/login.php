<?php
try {
    $pdo = new PDO(
        'pgsql:host=db;dbname=vuln_db;port=5432',
        'postgres',
        'password',
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );
    echo "PostgreSQL-OK!";
} catch (PDOException $e) {
    die("Ошибка подключения к БД: " . $e->getMessage());
}

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
$stmt = $pdo->query($sql);
$user = $stmt->fetch(); // Используем fetch() для одной записи

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