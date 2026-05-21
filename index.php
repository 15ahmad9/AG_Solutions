<?php

require_once 'config/db.php';

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
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
      <nav>

        <a href="#contact" class="btn">ابدأ مشروعك</a>

        <ul class="nav-links">
          <li><a href="#contact">تواصل معنا</a></li>
          <li><a href="#projects">أعمالنا</a></li>
          <li><a href="#about">من نحن</a></li>
          <li><a href="#services">الخدمات</a></li>
          <li><a href="#home">الرئيسية</a></li>
        </ul>

        <a href="#" class="logo">
          <img src="assets/images/AG_Logo_RBG.png" alt="AG Solutions Logo">
        </a>

      </nav>
    </div>
  </header>

  <!-- Hero -->

  <section class="hero" id="home">
    <div class="container">
      <div class="hero-content">

        <div class="hero-text">
          <h1>
            نبني <span>مواقع إلكترونية</span>
            احترافية تعكس قوة مشروعك
          </h1>

          <p>
            نقدم حلول تطوير ويب حديثة، سريعة ومتجاوبة تساعد الشركات والمتاجر والأعمال الناشئة على بناء حضور رقمي احترافي
            وتحويل الأفكار إلى مشاريع حقيقية قابلة للتطبيق على أرض الواقع.
          </p>

          <div class="hero-buttons">
            <a href="#projects" class="btn">شاهد أعمالنا</a>
            <a href="#contact" class="btn btn-outline">تواصل معنا</a>
          </div>
        </div>

<div class="hero-image">

  <div class="hero-slider">

    <img src="assets/images/hero_image1.jpg" class="hero-slide active" alt="">
    
    <img src="assets/images/hero_image2.jpg" class="hero-slide" alt="">
    
        <img src="assets/images/hero_image3.jpg" class="hero-slide" alt="">

    <img src="assets/images/hero_image4.png" class="hero-slide" alt="">


  </div>

</div>

      </div>
    </div>
  </section>

  <!-- About -->

  <section id="about">
    <div class="container">

      <div class="about-content">

        <div class="about-image">
          <img src="assets/images/AG_Logo_RBG.png" alt="About AG Solutions">
        </div>

        <div class="about-text">
          <h2> من نحن ؟؟ </h2>

          <p>
            في AG Solutions، نعمل على تقديم حلول ويب وتقنية احترافية تساعد الشركات وأصحاب المشاريع على بناء حضور رقمي
            قوي واحترافي، من خلال مواقع حديثة، أنظمة مخصصة، وتجربة مستخدم عالية الجودة، وتساعدك على الوصول إلى عملائك
            بشكل أفضل.
          </p>

          <div class="about-features">

            <div class="feature">
              <i class="fa-solid fa-check"></i>
              <span>تصميم عصري</span>
            </div>

            <div class="feature">
              <i class="fa-solid fa-check"></i>
              <span>أداء عالي</span>
            </div>

            <div class="feature">
              <i class="fa-solid fa-check"></i>
              <span>متوافق مع جميع الأجهزة</span>
            </div>

            <div class="feature">
              <i class="fa-solid fa-check"></i>
              <span>تحسين SEO</span>
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
        <h2>خدماتنا</h2>
        <p>
          نقدم حلول ويب متكاملة تجمع بين التصميم الحديث والأداء العالي.
        </p>
      </div>

      <div class="services-grid">

        <div class="service-card">
          <i class="fa-solid fa-laptop-code"></i>

          <div class="service-counter">
            <span class="counter" data-target="46">0</span>
            <span class="plus">+</span>
          </div>

          <h3>تصميم مواقع</h3>

          <p>
            تصميم مواقع احترافية متجاوبة مع جميع الأجهزة.
          </p>
        </div>

        <div class="service-card">
          <i class="fa-solid fa-cart-shopping"></i>

          <div class="service-counter">
            <span class="counter" data-target="4">0</span>
            <span class="plus">+</span>
          </div>

          <h3>متاجر إلكترونية</h3>

          <p>
            إنشاء متاجر حديثة وسريعة مع تجربة مستخدم ممتازة.
          </p>
        </div>

        <div class="service-card">
          <i class="fa-solid fa-code"></i>

          <div class="service-counter">
            <span class="counter" data-target="19">0</span>
            <span class="plus">+</span>
          </div>

          <h3>تطوير Full Stack</h3>

          <p>
            تطوير Frontend و Backend باستخدام أحدث التقنيات.
          </p>
        </div>

      </div>
    </div>
  </section>



  <!-- Projects -->

  <section id="projects">
    <div class="container">

      <div class="section-title">
        <h2>أعمالنا</h2>
        <p>
          مجموعة من المشاريع التي قمنا بتطويرها باحترافية عالية.
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

            <a href="project-food.html" class="btn">عرض المشروع</a>
          </div>
        </div>

        <div class="project-card">
          <div class="project-image">
            <img src="images/AG_Logo.png" alt="Portfolio Website">
          </div>

          <div class="project-content">
            <h3>Portfolio Website</h3>
            <p>
              موقع شخصي احترافي لعرض الخدمات والأعمال.
            </p>

            <a href="#" class="btn">عرض المشروع</a>
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

            <a href="#" class="btn">عرض المشروع</a>
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

              <img src="<?= htmlspecialchars($projectImage['image']) ?>" alt="<?= htmlspecialchars($project['title']) ?>">

            </div>

            <div class="project-content">

              <h3>
                <?= htmlspecialchars($project['title']) ?>
              </h3>

              <p>
                <?= htmlspecialchars($project['description']) ?>
              </p>

              <a href="project.php?id=<?= $project['id'] ?>" class="btn">
                عرض المشروع
              </a>

            </div>

          </div>

        <?php endforeach; ?>

      </div>
  </section>

  <!-- Contact -->

  <section id="contact">
    <div class="container">

      <div class="section-title">
        <h2>تواصل معنا</h2>
        <p>
          جاهزون لتحويل فكرتك إلى موقع احترافي.
        </p>
      </div>

      <div class="contact-content">

        <div class="contact-form">
          <?php if ($success): ?>

            <div class="success-message">
              تم إرسال رسالتك بنجاح
            </div>

          <?php endif; ?>
          <form method="POST">

            <div class="input-group">
              <input type="text" name="name" placeholder="الاسم الكامل" required>
            </div>

            <div class="input-group">
              <input type="email" name="email" placeholder="البريد الإلكتروني" required>
            </div>

            <div class="input-group">
              <textarea name="message" rows="6" placeholder="اكتب رسالتك" required></textarea>
            </div>

            <button class="btn" type="submit">
              إرسال الرسالة
            </button>

          </form>
        </div>

        <div class="contact-info">
          <h3>معلومات التواصل</h3>

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
        <script>document.write(new Date().getFullYear())</script> All rights reserved to AG Solutions
      </p>
    </div>
  </footer>

  <!-- Custom JS -->
  <script src="assets/js/main.js"></script>

</body>

</html>