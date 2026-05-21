<?php

require_once 'config/db.php';

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

$currentProject = $stmt->fetch();

if(!$currentProject){
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

?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        <?= $currentProject['title'] ?>
    </title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>

    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>
  <!-- Header -->

  <header id="header">
    <div class="container">
      <nav>
        <ul class="nav-links">
          <li><a href="contact.php">تواصل معنا</a></li>
          <li><a href="projects.php">أعمالنا</a></li>
          <li><a href="index.php">الرئيسية</a></li>
        </ul>

        <a href="index.php" class="logo">
          <img src="assets/images/AG_Logo_RBG.png" alt="AG Solutions Logo">
        </a>

      </nav>
    </div>
  </header>
<section class="single-project">

    <div class="container">

        <!-- Content -->

        <div class="project-details">

            <h1>
                <?= $currentProject['title'] ?>
            </h1>

            <p class="project-description">
                <?= nl2br($currentProject['content']) ?>
            </p>

            <div class="project-tech">

                <h3>
                    التقنيات المستخدمة
                </h3>

                <p>
                    <?= $currentProject['technologies'] ?>
                </p>

            </div>

            <a href="index.php" class="btn">
                العودة للرئيسية
            </a>

        </div>

        <!-- Slider -->

        <?php if(count($images) > 0): ?>

        <div class="slider">

            <button class="slider-btn prev">
                <i class="fa-solid fa-chevron-right"></i>
            </button>

            <div class="slides">

                <?php foreach($images as $image): ?>

                    <div class="slide">

                        <img
                            src="<?= $image['image'] ?>"
                            alt="<?= $currentProject['title'] ?>"
                        >

                    </div>

                <?php endforeach; ?>

            </div>

            <button class="slider-btn next">
                <i class="fa-solid fa-chevron-left"></i>
            </button>

        </div>

        <?php endif; ?>

    </div>

</section>

<script src="assets/js/main.js"></script>

</body>
</html>