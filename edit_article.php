<?php
include 'db.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: dashboard.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM articles WHERE id = ?");
$stmt->execute([$id]);
$article = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $stmt = $pdo->prepare("UPDATE articles SET title = ?, content = ? WHERE id = ?");
    $stmt->execute([$title, $content, $id]);

    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать статью</title>
    <link rel="stylesheet" href="styles.css">
<script src="https://cdn.tiny.cloud/1/5is2s9oaszalfbc8zm3o8g6fs9zm7xauzgbkf0n1zxdzvq57/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#content',
            plugins: 'lists link image preview',
            toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright | bullist numlist | link image | preview',
            height: 300,
            setup: function (editor) {
                editor.on('change', function () {
                    editor.save(); // Сохраняем содержимое в оригинальный textarea
                });
            }
        });
    </script>
</head>
<body>
    <div class="container">
    <?php if (isset($_SESSION['user_id'])): ?>
    <a href="logout.php" class="btn" style="float: right;">Выход</a>
<?php endif; ?>
        <h1>Редактировать статью</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label for="title">Заголовок</label>
                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($article['title']); ?>" required>
            </div>
            <div class="form-group">
                <label for="content">Содержимое</label>
                <textarea id="content" name="content" required><?php echo htmlspecialchars($article['content']); ?></textarea>
            </div>
            <button type="submit" class="btn">Сохранить</button>
            <a href="dashboard.php" class="btn">Назад</a>
        </form>
    </div>
</body>
</html>