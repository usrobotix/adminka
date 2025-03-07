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
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $middle_name = $_POST['middle_name'];
    $birth_year = $_POST['birth_year'];
    $position = $_POST['position'];
    $phone = $_POST['phone'];
    $telegram = $_POST['telegram'];
    $whatsapp = $_POST['whatsapp'];
    $email = $_POST['email'];
    $specialization = $_POST['specialization'];
    $role_id = $_POST['role_id'];

    // Обработка загрузки файла
    $photo = $user['photo']; // Сохраняем старое значение по умолчанию
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == UPLOAD_ERR_OK) {
        $file = $_FILES['photo'];
        $allowed_types = ['image/jpeg', 'image/png', 'image/svg+xml'];
        $max_size = 5 * 1024 * 1024; // 5 MB
        $max_width = 400;
        $max_height = 400;

        // Проверка типа файла
        if (!in_array($file['type'], $allowed_types)) {
            die("Ошибка: Неверный тип файла. Допустимые типы: JPEG, PNG, SVG.");
        }

        // Проверка размера файла
        if ($file['size'] > $max_size) {
            die("Ошибка: Файл слишком большой. Максимальный размер: 5 МБ.");
        }

        // Проверка размеров изображения
        list($width, $height) = getimagesize($file['tmp_name']);
        if ($width > $max_width || $height > $max_height) {
            die("Ошибка: Изображение должно быть не больше 400x400 пикселей.");
        }

        // Перемещение загруженного файла
        $upload_dir = 'uploads/'; // Директория для загрузки
        $photo = $upload_dir . basename($file['name']);
        move_uploaded_file($file['tmp_name'], $photo);
    }

    $stmt = $pdo->prepare("UPDATE users SET username = ?, first_name = ?, last_name = ?, middle_name = ?, birth_year = ?, photo = ?, position = ?, phone = ?, telegram = ?, whatsapp = ?, email = ?, specialization = ?, role_id = ? WHERE id = ?");
    $stmt->execute([$username, $first_name, $last_name, $middle_name, $birth_year, $photo, $position, $phone, $telegram, $whatsapp, $email, $specialization, $role_id, $id]);

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
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                                <label for="username">Имя пользователя</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
            </div>
            <div class="form-group">
                <label for="first_name">Имя</label>
                <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="last_name">Фамилия</label>
                <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="middle_name">Отчество</label>
                <input type="text" id="middle_name" name="middle_name" value="<?php echo htmlspecialchars($user['middle_name']); ?>">
            </div>
            <div class="form-group">
                <label for="birth_year">Год рождения</label>
                <input type="number" id="birth_year" name="birth_year" value="<?php echo htmlspecialchars($user['birth_year']); ?>" required>
            </div>
            <div class="form-group">
                <label for="photo">Фотография (JPEG, PNG, SVG, до 5 МБ)</label>
                <input type="file" id="photo" name="photo" accept="image/jpeg, image/png, image/svg+xml">
                <?php if ($user['photo']): ?>
                    <img src="<?php echo htmlspecialchars($user['photo']); ?>" alt="Фото" style="width: 100px; height: auto;">
                <?php else: ?>
                    Нет фото
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="position">Должность</label>
                <input type="text" id="position" name="position" value="<?php echo htmlspecialchars($user['position']); ?>">
            </div>
            <div class="form-group">
                <label for="phone">Телефон</label>
                <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>">
            </div>
            <div class="form-group">
                <label for="telegram">Телеграм</label>
                <input type="text" id="telegram" name="telegram" value="<?php echo htmlspecialchars($user['telegram']); ?>">
            </div>
            <div class="form-group">
                <label for="whatsapp">Ватсап</label>
                <input type="text" id="whatsapp" name="whatsapp" value="<?php echo htmlspecialchars($user['whatsapp']); ?>">
            </div>
            <div class="form-group">
                <label for="email">Почта</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>">
            </div>
            <div class="form-group">
                <label for="specialization">Специализация</label>
                <input type="text" id="specialization" name="specialization" value="<?php echo htmlspecialchars($user['specialization']); ?>">
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