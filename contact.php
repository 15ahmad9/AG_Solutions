<?php

require_once 'config/db.php';
require_once 'config/lang.php';

$success = false;

/*
|--------------------------------------------------------------------------
| <?= t('send_message') ?>
|--------------------------------------------------------------------------
*/

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    if(!empty($name) && !empty($email) && !empty($message)){

        $stmt = $pdo->prepare("
            INSERT INTO contacts(name, email, message)
            VALUES(?,?,?)
        ");

        $stmt->execute([
            $name,
            $email,
            $message
        ]);

        header("Location: contact.php?success=1");
        exit;

    }

}

if(isset($_GET['success'])){
    $success = true;
}

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
        <?= t('contact') ?> | AG Solutions
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

    <style>

        .contact-page{
            padding:120px 0 80px;
            min-height:100vh;
        }

        .page-title{
            text-align:center;
            margin-bottom:60px;
        }

        .page-title h1{
            font-size:42px;
            margin-bottom:15px;
        }

        .page-title p{
            color:#777;
            font-size:18px;
        }

        .back-home{
            text-align:center;
            margin-top:50px;
        }

        @media(max-width:992px){

            .contact-content{
                grid-template-columns:1fr;
            }

        }

    </style>

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

<!-- Contact Page -->

<section class="contact-page">

    <div class="container">

        <div class="page-title">

            <h1>
                <?= t('contact') ?>
            </h1>

            <p>
                <?= t('contact_description') ?>
            </p>

        </div>

        <div class="contact-content">

            <!-- Form -->

            <div class="contact-form">

                <?php if($success): ?>

                    <div class="success-message">
                        <?= t('message_success') ?>
                    </div>

                <?php endif; ?>

                <form method="POST">

                    <div class="input-group">

                        <input type="text"
                               name="name"
                               placeholder="<?= t('full_name') ?>"
                               required>

                    </div>

                    <div class="input-group">

                        <input type="email"
                               name="email"
                               placeholder="<?= t('email') ?>"
                               required>

                    </div>

                    <div class="input-group">

                        <textarea name="message"
                                  rows="7"
                                  placeholder="<?= t('write_message') ?>"
                                  required></textarea>

                    </div>

                    <button class="btn" type="submit">
                        <?= t('send_message') ?>
                    </button>

                </form>

            </div>

            <!-- Contact Info -->

            <div class="contact-info">

                <h3>
                    <?= t('contact_info') ?>
                </h3>

                <div class="contact-item">

                    <i class="fa-brands fa-whatsapp"></i>

                    <span>
                        00962781977173
                    </span>

                </div>

                <div class="contact-item">

                    <i class="fa-brands fa-instagram"></i>

                    <a href="https://www.instagram.com/ag__solution?igsh=YmMwM2YxeWw3bm54"
                       target="_blank">

                        @ag__solution

                    </a>

                </div>

                <div class="contact-item">

                    <i class="fa-solid fa-envelope"></i>

                    <span>
                        agsolution.jo@gmail.com
                    </span>

                </div>

            </div>

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