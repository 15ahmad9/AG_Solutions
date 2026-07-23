<?php
require_once 'config/db.php';
require_once 'config/lang.php';

$stmt = $pdo->query("
    SELECT *
    FROM templates
    ORDER BY id DESC
");

$templates = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="<?= t('lang_code') ?>" dir="<?= t('dir') ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Templates | AG Solutions</title>

    <link rel="shortcut icon" href="assets/images/AG_Logo_RBG.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

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

<section class="templates-page">
    <div class="container">

        <div class="section-title">
            <h2><?= t('templates_heading') ?></h2>
            <p>
                <?= t('templates_description') ?>
            </p>
        </div>

        <div class="templates-grid">

            <?php if(count($templates) > 0): ?>
            <?php foreach($templates as $template): ?>

                <div class="template-card">

                    <div class="template-image">
                        <img src="<?= htmlspecialchars($template['image']) ?>" alt="<?= htmlspecialchars($template['title']) ?>">
                    </div>

                    <div class="template-content">

                        <h3>
                            <?= htmlspecialchars($template['title']) ?>
                        </h3>

                        <p>
                            <?= htmlspecialchars($template['description']) ?>
                        </p>

                        <div class="template-price">
                            <?= htmlspecialchars($template['price']) ?> <?= t('currency') ?>
                        </div>

                        <div class="template-actions">

                            <?php if(!empty($template['demo_link'])): ?>
                                <a href="<?= htmlspecialchars($template['demo_link']) ?>" target="_blank" class="btn btn-outline">
                                    <?= t('preview') ?>
                                </a>
                            <?php endif; ?>

                            <a href="contact.php" class="btn">
                                <?= t('buy_template') ?>
                            </a>

                        </div>

                    </div>

                </div>

            <?php endforeach; ?>
            <?php else: ?>
                <p class="empty-state"><?= t('no_templates') ?></p>
            <?php endif; ?>

        </div>

    </div>
</section>

<script src="assets/js/main.js"></script>

</body>
</html>
