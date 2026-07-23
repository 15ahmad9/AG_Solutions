<?php

require_once 'config/db.php';
require_once 'config/lang.php';

/*
|--------------------------------------------------------------------------
| جلب المشاريع من قاعدة البيانات
|--------------------------------------------------------------------------
*/

$stmt = $pdo->query("
    SELECT *
    FROM projects
    ORDER BY id DESC
");

$projects = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="<?= t('lang_code') ?>" dir="<?= t('dir') ?>">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <!-- logo icon -->
  <link rel="shortcut icon" href="assets/images/AG_Logo_RBG.png" type="image/x-icon">

    <title>
        <?= t('projects') ?> | AG Solutions
    </title>

    <!-- Google Fonts -->

    <link rel="preconnect"
          href="https://fonts.googleapis.com">

    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap"
          rel="stylesheet">

    <!-- Font Awesome -->

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>

    <!-- CSS -->

    <link rel="stylesheet"
          href="assets/css/style.css">
</head>

<body>

<!-- Header -->

<header id="header">
  <div class="container">
    <nav class="navbar">
      <a href="index.php" class="logo" aria-label="AG Solutions">
        <img src="assets/images/AG_Logo_RBG.png" alt="AG Solutions Logo">
      </a>

      <button class="menu-toggle" type="button" aria-label="Open menu">
        <span></span><span></span><span></span>
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
        <i class="fa-solid fa-arrow-up-right-from-square"></i>
        <?= t('start_project') ?>
      </a>

      <button class="theme-toggle" type="button" aria-label="Toggle theme">
        <i class="fa-solid fa-moon"></i>
      </button>

      <div class="lang-switcher">
        <a href="<?= switch_lang_url($lang === 'ar' ? 'en' : 'ar') ?>"
           class="language-toggle" aria-label="Switch language">
          <?= t('language') ?>
        </a>
      </div>
    </nav>
  </div>
</header>

<!-- Projects Page -->

<section class="projects-page">

    <div class="container">

        <div class="page-title">

            <h1>
                <?= t('projects') ?>
            </h1>

            <p>
                <?= t('projects_description') ?>
            </p>

        </div>

        <div class="projects-grid">

            <?php if(count($projects) > 0): ?>

                <?php foreach($projects as $project): ?>

                    <?php

                    /*
                    |--------------------------------------------------------------------------
                    | جلب أول صورة للمشروع
                    |--------------------------------------------------------------------------
                    */

                    $imageStmt = $pdo->prepare("
                        SELECT image
                        FROM project_images
                        WHERE project_id = ?
                        LIMIT 1
                    ");

                    $imageStmt->execute([$project['id']]);

                    $projectImage = $imageStmt->fetch();

                    ?>

                    <div class="project-card">

                        <div class="project-image">

                            <img 
                                src="<?= htmlspecialchars($projectImage['image'] ?? 'assets/images/AG_Logo_RBG.png') ?>" 
                                alt="<?= htmlspecialchars($project['title']) ?>"
                            >

                        </div>

                        <div class="project-content">

                            <h3>
                                <?= htmlspecialchars($project['title']) ?>
                            </h3>

                            <p>
                                <?= htmlspecialchars($project['description']) ?>
                            </p>

                            <a href="project.php?id=<?= $project['id'] ?>"
                               class="btn">

                                <?= t('view_project') ?>

                            </a>

                            <?php if(!empty($project['website_url'])): ?>

                            <a href="<?= htmlspecialchars($project['website_url']) ?>"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="btn btn-outline">
                                <i class="fa-solid fa-arrow-up-right-from-square"></i>

                                <?= t('visit_website') ?>

                            </a>

                            <?php endif; ?>

                        </div>

                    </div>

                <?php endforeach; ?>

            <?php else: ?>

                <p>
                    <?= t('no_projects') ?>
                </p>

            <?php endif; ?>

        </div>

        <div class="back-home">

            <a href="index.php" class="btn">
                <?= t('back_home') ?>
            </a>

        </div>

    </div>

</section>

<script src="assets/js/main.js"></script>
</body>

</html>