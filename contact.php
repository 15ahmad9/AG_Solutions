<?php

require_once 'config/db.php';

$success = false;

/*
|--------------------------------------------------------------------------
| إرسال الرسالة
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
<html lang="ar" dir="rtl">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        تواصل معنا | AG Solutions
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

        <nav>

<ul class="nav-links">
          <li><a href="projects.php">أعمالنا</a></li>
          <li><a href="index.php">الرئيسية</a></li>
        </ul>

            <a href="index.php" class="logo">

                <img src="assets/images/AG_Logo_RBG.png"
                     alt="AG Solutions">

            </a>

        </nav>

    </div>

</header>

<!-- Contact Page -->

<section class="contact-page">

    <div class="container">

        <div class="page-title">

            <h1>
                تواصل معنا
            </h1>

            <p>
                جاهزون لتحويل فكرتك إلى موقع احترافي
            </p>

        </div>

        <div class="contact-content">

            <!-- Form -->

            <div class="contact-form">

                <?php if($success): ?>

                    <div class="success-message">
                        تم إرسال رسالتك بنجاح
                    </div>

                <?php endif; ?>

                <form method="POST">

                    <div class="input-group">

                        <input type="text"
                               name="name"
                               placeholder="الاسم الكامل"
                               required>

                    </div>

                    <div class="input-group">

                        <input type="email"
                               name="email"
                               placeholder="البريد الإلكتروني"
                               required>

                    </div>

                    <div class="input-group">

                        <textarea name="message"
                                  rows="7"
                                  placeholder="اكتب رسالتك"
                                  required></textarea>

                    </div>

                    <button class="btn" type="submit">
                        إرسال الرسالة
                    </button>

                </form>

            </div>

            <!-- Contact Info -->

            <div class="contact-info">

                <h3>
                    معلومات التواصل
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
                العودة للرئيسية
            </a>

        </div>

    </div>

</section>

<script src="assets/js/main.js"></script>

</body>

</html>