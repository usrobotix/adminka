<?php
session_start();
include 'db.php';

// Проверка прав доступа
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT role_id FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$current_user = $stmt->fetch(PDO::FETCH_ASSOC);

// Получаем статьи в зависимости от роли
if ($current_user['role_id'] == 1) { // Автор
    $stmt = $pdo->prepare("SELECT * FROM articles WHERE author_id = ?");
    $stmt->execute([$user_id]);
} else { // Модератор или Администратор
    $stmt = $pdo->query("SELECT * FROM articles");
}
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Дашборд</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
    <?php if (isset($_SESSION['user_id'])): ?>
    <a href="logout.php" class="btn" style="float: right;">Выход</a>
<?php endif; ?>
        <h1>Дашборд</h1>
        <a href="add_article.php" class="btn">Добавить статью</a>
        <h2>Список статей</h2>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Заголовок</th>
            <th>Автор</th>
            <th>Дата создания</th>
            <th>Дата редактирования</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($articles as $article): ?>
            <tr>
                <td><?php echo $article['id']; ?></td>
                <td><?php echo htmlspecialchars($article['title']); ?></td>
                <td><?php
                    $author_stmt = $pdo->prepare("SELECT username FROM users WHERE id = ?");
                    $author_stmt->execute([$article['author_id']]);
                    $author = $author_stmt->fetch(PDO::FETCH_ASSOC);
                    echo htmlspecialchars($author['username']);
                ?></td>
                <td><?php echo $article['created_at']; ?></td>
                <td><?php echo $article['updated_at']; ?></td>
                <td>
                    <a href="edit_article.php?id=<?php echo $article['id']; ?>">Редактировать</a>
                    <a href="delete_article.php?id=<?php echo $article['id']; ?>" onclick="return confirm('Вы уверены, что хотите удалить эту статью?');">Удалить</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
    <?    // После получения статей добавьте следующий код
if ($current_user['role_id'] == 3 || $current_user['role_id'] == 2) { // Администратор или Модератор
    // Получаем всех пользователей
    $stmt = $pdo->query("SELECT u.id, u.username, r.name AS role FROM users u JOIN roles r ON u.role_id = r.id");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<h2>Список пользователей</h2>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Имя пользователя</th>
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
                <td><?php echo htmlspecialchars($user['username']); ?></td>
                <td><?php echo htmlspecialchars($user['role']); ?></td>
                <?php if ($current_user['role_id'] == 3): // Только для администратора ?>
                    <td>
                        <a href="edit_user.php?id=<?php echo $user['id']; ?>">Редактировать</a>
                        <a href="delete_user.php?id=<?php echo $user['id']; ?>" onclick="return confirm('Вы уверены, что хотите удалить этого пользователя?');">Удалить</a>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
    </div>
</body>
</html>