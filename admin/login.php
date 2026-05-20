<?php

session_start();

require_once '../config/db.php';

$error = "";

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("
        SELECT * FROM admins
        WHERE username = ?
    ");

    $stmt->execute([$username]);

    $admin = $stmt->fetch();

    if($admin && password_verify($password, $admin['password'])){

        $_SESSION['admin'] = $admin['id'];

        header("Location: dashboard.php");
        exit;

    } else {

        $error = "بيانات الدخول غير صحيحة";

    }

}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>تسجيل الدخول</title>

    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<div class="admin-page">

    <div class="admin-card">

        <h1>
            تسجيل الدخول
        </h1>

        <?php if($error): ?>

            <div class="message error">
                <?= $error ?>
            </div>

        <?php endif; ?>

        <form method="POST">

            <div class="input-group">
                <input type="text" name="username" placeholder="اسم المستخدم">
            </div>

            <div class="input-group">
                <input type="password" name="password" placeholder="كلمة المرور">
            </div>

            <button type="submit" class="btn">
                دخول
            </button>

        </form>

    </div>

</div>

</body>
</html>