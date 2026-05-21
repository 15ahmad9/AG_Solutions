<?php

require_once 'config/db.php';

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
<html lang="ar" dir="rtl">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        أعمالنا | AG Solutions
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

        .projects-page{
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
            margin-top:60px;
        }
    </style>

</head>

<body>

<!-- Header -->

<header id="header">

    <div class="container">

        <nav>

<ul class="nav-links">
          <li><a href="contact.php">تواصل معنا</a></li>
          <li><a href="index.php">الرئيسية</a></li>
        </ul>

            <a href="index.php" class="logo">

                <img src="assets/images/AG_Logo_RBG.png"
                     alt="AG Solutions">

            </a>

        </nav>

    </div>

</header>

<!-- Projects Page -->

<section class="projects-page">

    <div class="container">

        <div class="page-title">

            <h1>
                أعمالنا
            </h1>

            <p>
                مجموعة من المشاريع التي قمنا بتطويرها باحترافية عالية
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
                                src="<?= htmlspecialchars($projectImage['image']) ?>" 
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

                                عرض المشروع

                            </a>

                        </div>

                    </div>

                <?php endforeach; ?>

            <?php else: ?>

                <p>
                    لا توجد مشاريع حالياً
                </p>

            <?php endif; ?>

        </div>

        <div class="back-home">

            <a href="index.php" class="btn">
                العودة للرئيسية
            </a>

        </div>

    </div>

</section>

</body>

</html>