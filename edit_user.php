<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 3) {
    header("Location: dashboard.php");
    exit;
}

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: manage_users.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $role_id = $_POST['role_id'];

    $stmt = $pdo->prepare("UPDATE users SET username = ?, role_id = ? WHERE id = ?");
    $stmt->execute([$username, $role_id, $id]);

    header("Location: manage_users.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать пользователя</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Редактировать пользователя</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Имя пользователя</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
            </div>
            <div class="form-group">
                <label for="role_id">Роль</label>
                <select id="role_id" name="role_id" required>
                    <option value="1" <?php echo $user['role_id'] == 1 ? 'selected' : ''; ?>>Автор</option>
                    <option value="2" <?php echo $user['role_id'] == 2 ? 'selected' : ''; ?>>Модератор</option>
                    <option value="3" <?php echo $user['role_id'] == 3 ? 'selected' : ''; ?>>Администратор</option>
                </select>
            </div>
            <button type="submit" class="btn">Сохранить</button>
            <a href="manage_users.php" class="btn">Назад</a>
        </form>
    </div>
</body>
</html>