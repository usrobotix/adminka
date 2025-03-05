<?php
session_start();
include 'db.php';

// Проверка прав доступа
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

// Получаем роль текущего пользователя
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT role_id FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$current_user = $stmt->fetch(PDO::FETCH_ASSOC);

// Проверяем, является ли текущий пользователь администратором
if ($current_user['role_id'] != 3) { // 3 - ID роли "Администратор"
    header("Location: dashboard.php");
    exit;
}

// Получаем всех пользователей
$stmt = $pdo->query("SELECT u.id, u.username, r.name AS role FROM users u JOIN roles r ON u.role_id = r.id");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Обработка создания нового пользователя
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role_id = $_POST['role_id'];

    $stmt = $pdo->prepare("INSERT INTO users (username, password, role_id) VALUES (?, ?, ?)");
    $stmt->execute([$username, $password, $role_id]);

    header("Location: manage_users.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление пользователями</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Управление пользователями</h1>

        <h2>Создать нового пользователя</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Имя пользователя</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Пароль</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="role_id">Роль</label>
                <select id="role_id" name="role_id" required>
                    <option value="1">Автор</option>
                    <option value="2">Модератор</option>
                    <option value="3">Администратор</option>
                </select>
            </div>
            <button type="submit" class="btn">Создать пользователя</button>
        </form>

        <h2>Список пользователей</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Имя пользователя</th>
                    <th>Роль</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                        <td><?php echo htmlspecialchars($user['role']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>