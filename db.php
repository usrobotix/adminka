<?php
$host = 'localhost';
$db = 'tam6uk87_photon';
$user = 'tam6uk87_photon'; // Замените на ваше имя пользователя
$pass = '45nMKA16'; // Замените на ваш пароль

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Ошибка подключения: " . $e->getMessage();
}
?>