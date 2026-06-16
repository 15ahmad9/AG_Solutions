<?php
require_once 'config/db.php';

$stmt = $pdo->query("
    SELECT *
    FROM templates
    ORDER BY id DESC
");

$templates = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Templates | AG Solutions</title>

    <link rel="shortcut icon" href="assets/images/AG_Logo_RBG.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<header id="header">
    <div class="container">
        <nav class="navbar">

            <a href="index.php" class="logo">
                <img src="assets/images/AG_Logo_RBG.png" alt="AG Solutions Logo">
            </a>

            <ul class="nav-links">
                <li><a href="index.php">الرئيسية</a></li>
                <li><a href="projects.php">أعمالنا</a></li>
                <li><a href="contact.php">تواصل معنا</a></li>
            </ul>

            <a href="contact.php" class="btn">اطلب موقعك</a>

        </nav>
    </div>
</header>

<section class="templates-page">
    <div class="container">

        <div class="section-title">
            <h2>القوالب الجاهزة</h2>
            <p>
                اختر قالب موقع جاهز واحترافي، ويمكننا تخصيصه حسب اسم مشروعك وهويتك.
            </p>
        </div>

        <div class="templates-grid">

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
                            <?= htmlspecialchars($template['price']) ?> JOD
                        </div>

                        <div class="template-actions">

                            <?php if(!empty($template['demo_link'])): ?>
                                <a href="<?= htmlspecialchars($template['demo_link']) ?>" target="_blank" class="btn btn-outline">
                                    معاينة
                                </a>
                            <?php endif; ?>

                            <a href="contact.php" class="btn">
                                شراء القالب
                            </a>

                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    </div>
</section>

<script src="assets/js/main.js"></script>

</body>
</html>
