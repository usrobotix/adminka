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
$stmt = $pdo->query("SELECT u.id, u.username, u.first_name, u.last_name, u.middle_name, u.birth_year, u.photo, u.position, u.phone, u.telegram, u.whatsapp, u.email, u.specialization, r.name AS role FROM users u JOIN roles r ON u.role_id = r.id");
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
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="logout.php" class="btn" style="float: right;">Выход</a>
        <?php endif; ?>
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
                    <th>Имя</th>
                    <th>Фамилия</th>
                    <th>Отчество</th>
                    <th>Год рождения</th>
                    <th>Фотография</th>
                    <th>Должность</th>
                    <th>Телефон</th>
                    <th>Телеграм</th>
                    <th>Ватсап</th>
                    <th>Почта</th>
                    <th>Специализация</th>
                    <th>Роль</th>
                    <?php if ($current_user['role_id'] == 3): // Только для администратора ?>
                        <th>Действия</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo htmlspecialchars($user['first_name']); ?></td>
                        <td><?php echo htmlspecialchars($user['last_name']); ?></td>
                        <td><?php echo htmlspecialchars($user['middle_name']); ?></td>
                        <td><?php echo htmlspecialchars($user['birth_year']); ?></td>
                        <td>
                            <?php if ($user['photo']): ?>
                                <img src="<?php echo htmlspecialchars($user['photo']); ?>" alt="Фото" style="width: 50px; height: auto;">
                            <?php else: ?>
                                Нет фото
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($user['position']); ?></td>
                        <td><?php echo htmlspecialchars($user['phone']); ?></td>
                        <td><?php echo htmlspecialchars($user['telegram']); ?></td>
                        <td><?php echo htmlspecialchars($user['whatsapp']); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td><?php echo htmlspecialchars($user['specialization']); ?></td>
                        <td><?php echo htmlspecialchars($user['role']); ?></td>
                        <?php if ($current_user['role_id'] == 3): // Только для администратора ?>
                            <td>
                                <a href="edit_user.php?id=<?php echo $user['id']; ?>">Редактировать</a>
                                <a href="delete_user.php?id=<?php echo $user['id']; ?>" onclick="return confirm('Вы уверены, что хотите удалить этого пользователя?');">Удалить</a>
                                <?php if ($user['is_active']): ?>
                                    <a href="?action=deactivate&id=<?php echo $user['id']; ?>" onclick="return confirm('Вы уверены, что хотите деактивировать этого пользователя?');">Деактивировать</a>
                                <?php else: ?>
                                    <a href="?action=activate&id=<?php echo $user['id']; ?>" onclick="return confirm('Вы уверены, что хотите активировать этого пользователя?');">Активировать</a>
                                <?php endif; ?>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>