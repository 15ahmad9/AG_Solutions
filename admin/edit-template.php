<?php

session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}

require_once '../config/db.php';

$id = $_GET['id'] ?? 0;

$stmt = $pdo->prepare("SELECT * FROM templates WHERE id = ?");
$stmt->execute([$id]);
$template = $stmt->fetch();

if(!$template){
    die("القالب غير موجود");
}

$message = "";

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $price = trim($_POST['price']);
    $demo_link = trim($_POST['demo_link']);

    $imagePath = $template['image'];

    if(!empty($_FILES['image']['name'])){

        if(file_exists("../" . $template['image'])){
            unlink("../" . $template['image']);
        }

        $imageName = time() . '_' . basename($_FILES['image']['name']);
        $targetPath = "../uploads/" . $imageName;

        move_uploaded_file($_FILES['image']['tmp_name'], $targetPath);

        $imagePath = "uploads/" . $imageName;
    }

    $update = $pdo->prepare("
        UPDATE templates
        SET title = ?, description = ?, price = ?, image = ?, demo_link = ?
        WHERE id = ?
    ");

    $update->execute([
        $title,
        $description,
        $price,
        $imagePath,
        $demo_link,
        $id
    ]);

    header("Location: dashboard.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تعديل القالب</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="admin-page">
    <div class="admin-card">

        <h1>تعديل القالب</h1>

        <form method="POST" enctype="multipart/form-data">

            <div class="input-group">
                <input type="text" name="title" value="<?= htmlspecialchars($template['title']) ?>" required>
            </div>

            <div class="input-group">
                <textarea name="description" required><?= htmlspecialchars($template['description']) ?></textarea>
            </div>

            <div class="input-group">
                <input type="number" step="0.01" name="price" value="<?= htmlspecialchars($template['price']) ?>" required>
            </div>

            <div class="input-group">
                <input type="url" name="demo_link" value="<?= htmlspecialchars($template['demo_link']) ?>">
            </div>

            <div class="current-images">
                <div class="image-box">
                    <img src="../<?= htmlspecialchars($template['image']) ?>" alt="">
                </div>
            </div>

            <div class="input-group">
                <input type="file" name="image">
            </div>

            <button type="submit" class="btn">حفظ التعديلات</button>

        </form>

    </div>
</div>

</body>
</html>