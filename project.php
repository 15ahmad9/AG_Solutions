<?php

require_once 'config/db.php';
require_once 'config/lang.php';

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
    die(t('project_not_found'));
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
<html lang="<?= t('lang_code') ?>" dir="<?= t('dir') ?>">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- logo icon -->
  <link rel="shortcut icon" href="assets/images/AG_Logo_RBG.png" type="image/x-icon">

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
    <nav class="navbar">

      <a href="index.php" class="logo">
        <img src="assets/images/AG_Logo_RBG.png" alt="AG Solutions Logo">
      </a>


      <button class="menu-toggle" type="button" aria-label="Open menu">
        <span></span>
        <span></span>
        <span></span>
      </button>


<ul class="nav-links">
        <li><a href="index.php"><?= t('home') ?></a></li>
        <li><a href="index.php#services"><?= t('services') ?></a></li>
        <li><a href="index.php#about"><?= t('about') ?></a></li>
        <li><a href="templates.php"><?= t('templates') ?></a></li>
        <li><a href="projects.php"><?= t('projects') ?></a></li>
        <li><a href="contact.php"><?= t('contact') ?></a></li>
      </ul>

      <a href="contact.php" class="btn nav-cta">
        <?= t('start_project') ?>
      </a>

      
      <button class="theme-toggle" type="button" aria-label="Toggle theme">
        <i class="fa-solid fa-moon"></i>
      </button>

      <div class="lang-switcher">
        <a
          href="<?= switch_lang_url($lang === 'ar' ? 'en' : 'ar') ?>"
          class="language-toggle"
          aria-label="Switch language"
        >
          <?= t('language') ?>
        </a>
      </div>

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

            <?php if(!empty($currentProject['website_url'])): ?>

            <div class="project-website">

                <h3>
                    Website
                </h3>

                <a 
                    href="<?= htmlspecialchars($currentProject['website_url']) ?>"
                    class="btn"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    <i class="fa-solid fa-globe"></i>
                    Visit Website
                </a>

            </div>

            <?php endif; ?>


            <div class="project-tech">

                <h3>
                    <?= t('technologies_used') ?>
                </h3>

                <p>
                    <?= $currentProject['technologies'] ?>
                </p>

            </div>

            <a href="index.php" class="btn">
                <?= t('back_home') ?>
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