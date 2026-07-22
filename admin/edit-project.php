<?php

session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}

require_once '../config/db.php';

$id = $_GET['id'] ?? 0;

/*
|--------------------------------------------------------------------------
| جلب بيانات المشروع
|--------------------------------------------------------------------------
*/

$stmt = $pdo->prepare("
    SELECT *
    FROM projects
    WHERE id = ?
");

$stmt->execute([$id]);

$project = $stmt->fetch();

if(!$project){
    die("المشروع غير موجود");
}

/*
|--------------------------------------------------------------------------
| جلب صور المشروع
|--------------------------------------------------------------------------
*/

$imageStmt = $pdo->prepare("
    SELECT *
    FROM project_images
    WHERE project_id = ?
");

$imageStmt->execute([$id]);

$images = $imageStmt->fetchAll();

$message = "";

/*
|--------------------------------------------------------------------------
| تحديث المشروع
|--------------------------------------------------------------------------
*/

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $content = trim($_POST['content']);
    $technologies = trim($_POST['technologies']);
    $website_url = trim($_POST['website_url']);

    /*
    |--------------------------------------------------------------------------
    | تحديث البيانات
    |--------------------------------------------------------------------------
    */

    $updateStmt = $pdo->prepare("
        UPDATE projects
        SET
            title = ?,
            description = ?,
            content = ?,
            technologies = ?,
            website_url = ?
        WHERE id = ?
    ");

    $updateStmt->execute([
        $title,
        $description,
        $content,
        $technologies,
        $website_url,
        $id
    ]);

    /*
    |--------------------------------------------------------------------------
    | رفع صور جديدة
    |--------------------------------------------------------------------------
    */

    if(!empty($_FILES['images']['name'][0])){

        foreach($_FILES['images']['tmp_name'] as $key => $tmpName){

            if(empty($tmpName)){
                continue;
            }

            $imageName = time() . '_' . basename($_FILES['images']['name'][$key]);

            $targetPath = "../uploads/" . $imageName;

            move_uploaded_file($tmpName, $targetPath);

            /*
            |--------------------------------------------------------------------------
            | حفظ الصورة
            |--------------------------------------------------------------------------
            */

            $insertImage = $pdo->prepare("
                INSERT INTO project_images
                (
                    project_id,
                    image
                )
                VALUES(?, ?)
            ");

            $insertImage->execute([
                $id,
                "uploads/" . $imageName
            ]);

        }

    }

    $message = "تم تحديث المشروع بنجاح";

    /*
    |--------------------------------------------------------------------------
    | تحديث الصور بعد التعديل
    |--------------------------------------------------------------------------
    */

    $imageStmt = $pdo->prepare("
        SELECT *
        FROM project_images
        WHERE project_id = ?
    ");

    $imageStmt->execute([$id]);

    $images = $imageStmt->fetchAll();

}

?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        تعديل المشروع
    </title>

    <link rel="stylesheet" href="../assets/css/admin.css">

</head>

<body>

<div class="admin-page">

    <div class="admin-card">

        <h1>
            تعديل المشروع
        </h1>

        <?php if($message): ?>

            <div class="message success">
                <?= $message ?>
            </div>

        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">

            <div class="input-group">

                <input
                    type="text"
                    name="title"
                    value="<?= htmlspecialchars($project['title']) ?>"
                    required
                >

            </div>

            <div class="input-group">

                <input
                    type="text"
                    name="description"
                    value="<?= htmlspecialchars($project['description']) ?>"
                    required
                >

            </div>

            <div class="input-group">

                <textarea
                    name="content"
                ><?= htmlspecialchars($project['content']) ?></textarea>

            </div>

            <div class="input-group">

                <input
                    type="text"
                    name="technologies"
                    value="<?= htmlspecialchars($project['technologies']) ?>"
                >

            </div>

            <div class="input-group">

                <input
                    type="url"
                    name="website_url"
                    value="<?= htmlspecialchars($project['website_url'] ?? '') ?>"
                    placeholder="رابط الموقع (https://example.com)"
                >

            </div>

            <!-- الصور الحالية -->

<div class="current-images">

    <?php foreach($images as $img): ?>

        <div class="image-box">

            <img src="../<?= $img['image'] ?>" alt="">

            <a 
                href="delete-image.php?id=<?= $img['id'] ?>"
                class="delete-image-btn"
                onclick="return confirm('هل أنت متأكد من حذف الصورة؟')"
            >
                حذف الصورة
            </a>

        </div>

    <?php endforeach; ?>

</div>

            <!-- إضافة صور جديدة -->

            <div class="input-group">

                <label>
                    إضافة صور جديدة
                </label>

                <input
                    type="file"
                    name="images[]"
                    multiple
                >

            </div>

            <button type="submit" class="btn">
                حفظ التعديلات
            </button>

        </form>

    </div>

</div>

</body>
</html>