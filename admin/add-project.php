<?php

session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}

require_once '../config/db.php';

$message = "";

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $technologies = trim($_POST['technologies']);
    $content = trim($_POST['content']);

    /*
    |--------------------------------------------------------------------------
    | إضافة المشروع داخل قاعدة البيانات
    |--------------------------------------------------------------------------
    */

    $stmt = $pdo->prepare("
        INSERT INTO projects
        (
            title,
            description,
            content,
            technologies
        )
        VALUES(?, ?, ?, ?)
    ");

    $stmt->execute([
        $title,
        $description,
        $content,
        $technologies
    ]);

    /*
    |--------------------------------------------------------------------------
    | الحصول على ID المشروع
    |--------------------------------------------------------------------------
    */

    $projectId = $pdo->lastInsertId();

    /*
    |--------------------------------------------------------------------------
    | رفع الصور
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
            | حفظ الصور داخل قاعدة البيانات
            |--------------------------------------------------------------------------
            */

            $imageStmt = $pdo->prepare("
                INSERT INTO project_images
                (
                    project_id,
                    image
                )
                VALUES(?, ?)
            ");

            $imageStmt->execute([
                $projectId,
                "uploads/" . $imageName
            ]);

        }

    }

    $message = "تم إضافة المشروع بنجاح";

}

?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        إضافة مشروع
    </title>

    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<div class="admin-page">

    <div class="admin-card">

        <h1>
            إضافة مشروع
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
                    placeholder="اسم المشروع"
                    required
                >

            </div>

            <div class="input-group">

                <input
                    type="text"
                    name="description"
                    placeholder="وصف قصير"
                    required
                >

            </div>

            <div class="input-group">

                <textarea
                    name="content"
                    placeholder="شرح المشروع"
                ></textarea>

            </div>

            <div class="input-group">

                <input
                    type="text"
                    name="technologies"
                    placeholder="التقنيات المستخدمة"
                >

            </div>

            <div class="input-group">

                <input
                    type="file"
                    name="images[]"
                    multiple
                    required
                >

            </div>

            <button type="submit" class="btn">
                إضافة المشروع
            </button>

        </form>

    </div>

</div>

</body>
</html>