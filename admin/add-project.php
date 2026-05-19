<?php

$message = "";

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $title = $_POST['title'];
    $description = $_POST['description'];
    $technologies = $_POST['technologies'];
    $content = $_POST['content'];

    // قراءة المشاريع الحالية

    $projects = json_decode(file_get_contents('../data/projects.json'), true);

    // إنشاء ID جديد

    $newId = count($projects) > 0
        ? end($projects)['id'] + 1
        : 1;

    // رفع الصورة

    $imageName = time() . '_' . $_FILES['image']['name'];

    $targetPath = "../uploads/" . $imageName;

    move_uploaded_file($_FILES['image']['tmp_name'], $targetPath);

    // إنشاء المشروع الجديد

    $newProject = [

        "id" => $newId,

        "title" => $title,

        "description" => $description,

        "image" => "uploads/" . $imageName,

        "technologies" => $technologies,

        "content" => $content

    ];

    // إضافة المشروع للمصفوفة

    $projects[] = $newProject;

    // حفظ داخل JSON

    file_put_contents(
        '../data/projects.json',
        json_encode($projects, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
    );

    $message = "تم إضافة المشروع بنجاح";

}

?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>إضافة مشروع</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="../assets/css/admin.css">

</head>

<body>

<div class="container">

  <div class="card">

    <h1>
      إضافة مشروع جديد
    </h1>

    <?php if($message): ?>

      <div class="message">
        <?= $message ?>
      </div>

    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">

      <div class="input-group">
        <input type="text" name="title" placeholder="اسم المشروع" required>
      </div>

      <div class="input-group">
        <input type="text" name="description" placeholder="وصف قصير" required>
      </div>

      <div class="input-group">
        <textarea name="content" placeholder="شرح المشروع"></textarea>
      </div>

      <div class="input-group">
        <input type="text" name="technologies" placeholder="التقنيات المستخدمة">
      </div>

      <div class="input-group">
        <input type="file" name="image" required>
      </div>

      <button type="submit" class="btn">
        إضافة المشروع
      </button>

    </form>

  </div>

</div>

</body>
</html>