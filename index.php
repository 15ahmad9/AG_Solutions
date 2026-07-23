<?php

require_once 'config/db.php';
require_once 'config/lang.php';

$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $name = trim($_POST['name']);
  $email = trim($_POST['email']);
  $message = trim($_POST['message']);

  if (!empty($name) && !empty($email) && !empty($message)) {

    $stmt = $pdo->prepare("
            INSERT INTO contacts(name, email, message)
            VALUES(?,?,?)
        ");

    $stmt->execute([
      $name,
      $email,
      $message
    ]);

    header("Location: index.php?success=1");

    exit;

  }

}

if (isset($_GET['success'])) {

  $success = true;

}

$stmt = $pdo->query("
    SELECT * FROM projects
    ORDER BY id DESC
");

$projects = $stmt->fetchAll();

?>


<!DOCTYPE html>
<html lang="<?= t('lang_code') ?>" dir="<?= t('dir') ?>">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- logo icon -->
  <link rel="shortcut icon" href="assets/images/AG_Logo_RBG.png" type="image/x-icon">

  <title>AG Solutions</title>

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap"
    rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />

  <!-- Custom CSS -->
  <link rel="stylesheet" href="assets/css/style.css" />

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

  <!-- Hero -->

  <section class="hero" id="home">
    <div class="hero-marquee hero-marquee-top"><div><span>IDEA</span> <b>DESIGN</b> <span>DEVELOPMENT</span> <b>TESTING</b> <span>LAUNCH</span> <b>GROWTH</b> <span>DIGITAL SUCCESS</span></div></div>
    <div class="hero-marquee hero-marquee-bottom"><div><b>PLAN</b> <span>CREATE</span> <b>BUILD</b> <span>DEPLOY</span> <b>OPTIMIZE</b> <span>EXPAND</span></div></div>
    <div class="container">
      <div class="hero-content">

        <div class="hero-text">
          <div class="hero-badge"><?= t('hero_badge') ?></div>
          <h1>
            <?= t('hero_title_before') ?> <span><?= t('hero_title_highlight') ?></span>
            <?= t('hero_title_after') ?>
          </h1>

          <p>
            <?= t('hero_description') ?>
          </p>

          <div class="hero-buttons">
            <a href="#projects" class="btn"><i class="fa-solid fa-arrow-down"></i><?= t('view_projects') ?></a>
            <a href="#contact" class="btn btn-outline"><i class="fa-regular fa-paper-plane"></i><?= t('contact') ?></a>
          </div>

          <div class="hero-stats">
            <div class="hero-stat"><strong>60+</strong><span><?= t('hero_stat_projects') ?></span></div>
            <div class="hero-stat"><strong>100%</strong><span><?= t('hero_stat_responsive') ?></span></div>
            <div class="hero-stat"><strong>24/7</strong><span><?= t('hero_stat_support') ?></span></div>
          </div>
        </div>

<div class="hero-image">

  <div class="hero-slider">

    <img src="assets/images/hero_image1.png" class="hero-slide active" alt="">
    
    <img src="assets/images/hero_image2.jpg" class="hero-slide" alt="">
    
        <img src="assets/images/hero_image3.png" class="hero-slide" alt="">

    <img src="assets/images/hero_image4.png" class="hero-slide" alt="">


  </div>

</div>

      </div>
    </div>
  <div class="hero-marquee hero-marquee-bottom"><div><b>FROM IDEA</b> <span>TO DESIGN</span> <b>TO DEVELOPMENT</b> <span>TO LAUNCH</span> <b>YOUR DIGITAL FUTURE</b></div></div>
  </section>

  <!-- About -->

  <section id="about">
    <div class="container">

      <div class="about-content">

        <div class="about-image">
          <img src="assets/images/AG_Logo_RBG.png" alt="About AG Solutions">
        </div>

        <div class="about-text">
          <h2> <?= t('about_heading') ?> </h2>

          <p>
            <?= t('about_description') ?>
          </p>

          <div class="about-features">

            <div class="feature">
              <i class="fa-solid fa-check"></i>
              <span><?= t('modern_design') ?></span>
            </div>

            <div class="feature">
              <i class="fa-solid fa-check"></i>
              <span><?= t('high_performance') ?></span>
            </div>

            <div class="feature">
              <i class="fa-solid fa-check"></i>
              <span><?= t('responsive_devices') ?></span>
            </div>

            <div class="feature">
              <i class="fa-solid fa-check"></i>
              <span><?= t('seo_optimization') ?></span>
            </div>

          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- Services -->

  <section id="services">
    <div class="container">

      <div class="section-title">
        <h2><?= t('services_heading') ?></h2>
        <p>
          <?= t('services_description') ?>
        </p>
      </div>

      <div class="services-grid">

        <article class="service-card">
          <i class="fa-solid fa-laptop-code"></i>

          <div class="service-counter">
            <span class="counter" data-target="46">0</span>
            <span class="plus">+</span>
          </div>

          <h3><?= t('web_design') ?></h3>

          <p>
            <?= t('web_design_desc') ?>
          </p>
        </article>

        <article class="service-card">
          <i class="fa-solid fa-cart-shopping"></i>

          <div class="service-counter">
            <span class="counter" data-target="4">0</span>
            <span class="plus">+</span>
          </div>

          <h3><?= t('ecommerce') ?></h3>

          <p>
            <?= t('ecommerce_desc') ?>
          </p>
        </article>

        <article class="service-card">
          <i class="fa-solid fa-code"></i>

          <div class="service-counter">
            <span class="counter" data-target="19">0</span>
            <span class="plus">+</span>
          </div>

          <h3><?= t('full_stack') ?></h3>

          <p>
            <?= t('full_stack_desc') ?>
          </p>
        </article>

      </div>
    </div>
  </section>



  <!-- Process -->
  <section class="process-section premium-process launch-journey" id="process">
    <div class="container">
      <div class="section-title">
        <h2><?= t('process_heading') ?></h2>
        <p><?= t('process_description') ?></p>
      </div>

      <div class="process-grid premium-timeline animated-timeline" role="list">
        <article class="process-card journey-card process-discovery" role="listitem">
          <span class="step-number" aria-hidden="true">01</span>
          <h3><?= t('process_discovery') ?></h3>
          <p><?= t('process_discovery_desc') ?></p>
        </article>

        <article class="process-card journey-card process-strategy" role="listitem">
          <span class="step-number" aria-hidden="true">02</span>
          <h3><?= t('process_strategy') ?></h3>
          <p><?= t('process_strategy_desc') ?></p>
        </article>

        <article class="process-card journey-card process-design" role="listitem">
          <span class="step-number" aria-hidden="true">03</span>
          <h3><?= t('process_design') ?></h3>
          <p><?= t('process_design_desc') ?></p>
        </article>

        <article class="process-card journey-card process-development" role="listitem">
          <span class="step-number" aria-hidden="true">04</span>
          <h3><?= t('process_development') ?></h3>
          <p><?= t('process_development_desc') ?></p>
        </article>

        <article class="process-card journey-card process-launch" role="listitem">
          <span class="step-number" aria-hidden="true">05</span>
          <h3><?= t('process_launch') ?></h3>
          <p><?= t('process_launch_desc') ?></p>
        </article>
      </div>
    </div>
  </section>

  <!-- Projects -->

  <section id="projects">
    <div class="container">

      <div class="section-title">
        <h2><?= t('projects') ?></h2>
        <p>
          <?= t('projects_description') ?>
        </p>
      </div>

      <!-- <div class="projects-grid">

        <div class="project-card">
          <div class="project-image">
            <img src="images/AG_Logo.png" alt="Food Ordering System">
          </div>

          <div class="project-content">
            <h3>Food Ordering System</h3>
            <p>
              نظام طلب طعام متكامل باستخدام React و Node.js.
            </p>

            <a href="project-food.html" class="btn"><?= t('view_project') ?></a>
          </div>
        </div>

        <div class="project-card">
          <div class="project-image">
            <img src="images/AG_Logo.png" alt="Portfolio Website">
          </div>

          <div class="project-content">
            <h3>Portfolio Website</h3>
            <p>
              موقع شخصي احترافي لعرض <?= t('services') ?> والأعمال.
            </p>

            <a href="#" class="btn"><?= t('view_project') ?></a>
          </div>
        </div>

        <div class="project-card">
          <div class="project-image">
            <img src="images/AG_Logo.png" alt="Dashboard System">
          </div>

          <div class="project-content">
            <h3>Dashboard System</h3>
            <p>
              لوحة تحكم احترافية لإدارة البيانات والمستخدمين.
            </p>

            <a href="#" class="btn"><?= t('view_project') ?></a>
          </div>
        </div>

      </div> -->

      <?php

      $stmt = $pdo->query("
    SELECT *
    FROM projects
    ORDER BY id DESC
");

      $projects = $stmt->fetchAll();

      ?>

      <div class="projects-grid">

        <?php foreach ($projects as $project): ?>

          <?php

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

              <img src="<?= htmlspecialchars($projectImage['image'] ?? 'assets/images/AG_Logo_RBG.png') ?>" alt="<?= htmlspecialchars($project['title']) ?>">

            </div>

            <div class="project-content">

              <h3>
                <?= htmlspecialchars($project['title']) ?>
              </h3>

              <p>
                <?= htmlspecialchars($project['description']) ?>
              </p>

              <a href="project.php?id=<?= $project['id'] ?>" class="btn">
                <?= t('view_project') ?>
              </a>

            </div>

          </div>

        <?php endforeach; ?>

      </div>
    </div>
  </section>

  <!-- Contact -->

  <section id="contact">
    <div class="container">

      <div class="section-title">
        <h2><?= t('contact') ?></h2>
        <p>
          <?= t('contact_description') ?>
        </p>
      </div>

      <div class="contact-content">

        <div class="contact-form">
          <?php if ($success): ?>

            <div class="success-message">
              <?= t('message_success') ?>
            </div>

          <?php endif; ?>
          <form method="POST">

            <div class="input-group">
              <input type="text" name="name" placeholder="<?= t('full_name') ?>" required>
            </div>

            <div class="input-group">
              <input type="email" name="email" placeholder="<?= t('email') ?>" required>
            </div>

            <div class="input-group">
              <textarea name="message" rows="6" placeholder="<?= t('write_message') ?>" required></textarea>
            </div>

            <button class="btn" type="submit">
              <?= t('send_message') ?>
            </button>

          </form>
        </div>

        <div class="contact-info">
          <h3><?= t('contact_info') ?></h3>

          <div class="contact-item">
            <i class="fa-brands fa-whatsapp"></i>
            <span>00962781977173</span>
          </div>

          <div class="contact-item">

            <i class="fa-brands fa-instagram"></i>

            <a href="https://www.instagram.com/ag__solution?igsh=YmMwM2YxeWw3bm54" target="_blank">
              @ag__solution
            </a>

          </div>

          <div class="contact-item">
            <i class="fa-solid fa-envelope"></i>
            <span>agsolution.jo@gmail.com</span>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- Footer -->

  <footer>
    <div class="container">
      <p class="Copyright">Copyright &copy;
        <script>document.write(new Date().getFullYear())</script> <?= t('copyright') ?>
      </p>
    </div>
  </footer>

  <!-- Custom JS -->
  <script src="assets/js/main.js"></script>


  <button class="back-to-top" aria-label="Back to top">↑</button>

</body>

</html>