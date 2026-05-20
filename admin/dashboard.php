<?php

session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

require_once '../config/db.php';

/*
|--------------------------------------------------------------------------
| جلب المشاريع مع أول صورة
|--------------------------------------------------------------------------
*/

$stmt = $pdo->query("
    SELECT 
        projects.*,
        (
            SELECT image
            FROM project_images
            WHERE project_images.project_id = projects.id
            LIMIT 1
        ) AS project_image
    FROM projects
    ORDER BY projects.id DESC
");

$projects = $stmt->fetchAll();

/*
|--------------------------------------------------------------------------
| جلب رسائل التواصل
|--------------------------------------------------------------------------
*/

$messages = $pdo->query("
    SELECT *
    FROM contacts
    ORDER BY id DESC
")->fetchAll();

?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        لوحة التحكم
    </title>

    <link rel="stylesheet"
          href="../assets/css/style.css">

</head>

<body>

<div class="dashboard">

    <div class="container">

        <!-- Header -->
<h1>
                لوحة التحكم
            </h1>
        <div class="dashboard-header">

            

            <a href="add-project.php" class="btn">
                إضافة مشروع
            </a>

        <a href="logout.php" class="btn danger">
            تسجيل الخروج
        </a>
</div>
        

        <!-- Projects -->

        <div class="dashboard-grid">

            <?php if(count($projects) > 0): ?>

                <?php foreach ($projects as $project): ?>

                    <div class="dashboard-card">

                        <img 
                            src="../<?= htmlspecialchars($project['project_image']) ?>" 
                            alt="<?= htmlspecialchars($project['title']) ?>"
                        >

                        <h3>
                            <?= htmlspecialchars($project['title']) ?>
                        </h3>

                        <p>
                            <?= htmlspecialchars($project['description']) ?>
                        </p>

                        <div class="dashboard-actions">

                            <a href="edit-project.php?id=<?= $project['id'] ?>"
                               class="btn">
                                تعديل
                            </a>

                            <a href="delete-project.php?id=<?= $project['id'] ?>"
                               class="btn danger"
                               onclick="return confirm('هل أنت متأكد من حذف المشروع؟')">
                                حذف
                            </a>

                        </div>

                    </div>

                <?php endforeach; ?>

            <?php else: ?>

                <p>
                    لا يوجد مشاريع حالياً
                </p>

            <?php endif; ?>

        </div>

        <!-- Messages -->

        <div class="messages-section">

            <div class="messages-header">

                <h2>
                    رسائل التواصل
                </h2>

            </div>

            <div class="table-wrapper">

                <table class="messages-table">

                    <thead>

                        <tr>

                            <th>#</th>
                            <th>الاسم</th>
                            <th>البريد الإلكتروني</th>
                            <th>الرسالة</th>
                            <th>التاريخ</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php if(count($messages) > 0): ?>

                            <?php foreach ($messages as $msg): ?>

                                <tr>

                                    <td>
                                        <?= $msg['id'] ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($msg['name']) ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($msg['email']) ?>
                                    </td>

                                    <td class="message-text">
                                        <?= nl2br(htmlspecialchars($msg['message'])) ?>
                                    </td>

                                    <td>
                                        <?= $msg['created_at'] ?>
                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        <?php else: ?>

                            <tr>

                                <td colspan="5">
                                    لا توجد رسائل حالياً
                                </td>

                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

</body>

</html>