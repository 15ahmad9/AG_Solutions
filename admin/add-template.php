<?php

session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}

require_once '../config/db.php';

$message = "";
$error = "";

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $price = trim($_POST['price']);
    $demo_link = trim($_POST['demo_link']);

    /*
    |--------------------------------------------------------------------------
    | رفع صورة القالب
    |--------------------------------------------------------------------------
    */

    $imagePath = null;

    if(!empty($_FILES['image']['name'])){

        $imageName = time() . '_' . basename($_FILES['image']['name']);
        $targetPath = "../uploads/" . $imageName;

        $allowedImageTypes = ['jpg', 'jpeg', 'png', 'webp'];
        $imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

        if(!in_array($imageExtension, $allowedImageTypes)){

            $error = "نوع صورة القالب غير مدعوم. الرجاء رفع JPG أو PNG أو WEBP.";

        }else{

            if(move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)){
                $imagePath = "uploads/" . $imageName;
            }else{
                $error = "حدث خطأ أثناء رفع صورة القالب.";
            }

        }

    }

    /*
    |--------------------------------------------------------------------------
    | رفع ملف القالب ZIP
    |--------------------------------------------------------------------------
    */

    $templateFilePath = null;

    if(empty($error) && !empty($_FILES['template_file']['name'])){

        $templateFileName = time() . '_' . basename($_FILES['template_file']['name']);
        $templateTargetPath = "../uploads/templates/" . $templateFileName;

        $allowedFileTypes = ['zip'];
        $fileExtension = strtolower(pathinfo($templateFileName, PATHINFO_EXTENSION));

        if(!in_array($fileExtension, $allowedFileTypes)){

            $error = "يجب رفع ملف القالب بصيغة ZIP فقط.";

        }else{

            if(move_uploaded_file($_FILES['template_file']['tmp_name'], $templateTargetPath)){
                $templateFilePath = "uploads/templates/" . $templateFileName;
            }else{
                $error = "حدث خطأ أثناء رفع ملف القالب.";
            }

        }

    }

    /*
    |--------------------------------------------------------------------------
    | حفظ بيانات القالب
    |--------------------------------------------------------------------------
    */

    if(empty($error) && $imagePath && $templateFilePath){

        $stmt = $pdo->prepare("
            INSERT INTO templates
            (
                title,
                description,
                price,
                image,
                file_path,
                demo_link
            )
            VALUES(?, ?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $title,
            $description,
            $price,
            $imagePath,
            $templateFilePath,
            $demo_link
        ]);

        $message = "تم إضافة القالب بنجاح";

    }

}

?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

    <meta charset="UTF-8">
    <title>إضافة قالب</title>

    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<div class="admin-page">

    <div class="admin-card">

        <h1>إضافة قالب جديد</h1>

        <?php if($message): ?>
            <div class="message success">
                <?= $message ?>
            </div>
        <?php endif; ?>

        <?php if($error): ?>
            <div class="message error">
                <?= $error ?>
            </div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">

            <div class="input-group">
                <input
                    type="text"
                    name="title"
                    placeholder="اسم القالب"
                    required
                >
            </div>

            <div class="input-group">
                <textarea
                    name="description"
                    placeholder="وصف القالب"
                    required
                ></textarea>
            </div>

            <div class="input-group">
                <input
                    type="number"
                    step="0.01"
                    name="price"
                    placeholder="السعر"
                    required
                >
            </div>

            <div class="input-group">
                <input
                    type="url"
                    name="demo_link"
                    placeholder="رابط المعاينة"
                >
            </div>

            <div class="input-group">
                <label>صورة القالب</label>
                <input
                    type="file"
                    name="image"
                    accept=".jpg,.jpeg,.png,.webp"
                    required
                >
            </div>

            <div class="input-group">
                <label>ملف القالب ZIP</label>
                <input
                    type="file"
                    name="template_file"
                    accept=".zip"
                    required
                >
            </div>

            <button type="submit" class="btn">
                إضافة القالب
            </button>

        </form>

    </div>

</div>

</body>
</html>