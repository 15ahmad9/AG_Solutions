<?php

$projects = json_decode(file_get_contents('data/projects.json'), true);

$id = $_GET['id'] ?? 0;

$currentProject = null;

foreach($projects as $project){

  if($project['id'] == $id){
    $currentProject = $project;
  }

}

if(!$currentProject){
  die("المشروع غير موجود");
}

?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title><?= $currentProject['title'] ?></title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="assets/css/style.css">

  <style>
        .project-image{
      width:100%;
      height:500px;
      overflow:hidden;
      border-radius:30px;
      margin-bottom:40px;
    }

    .project-image img{
      width:100%;
      height:100%;
      object-fit:cover;
    }
  </style>
</head>

<body>

<section>

  <div class="container">

    <div class="project-image">
      <img src="<?= $currentProject['image'] ?>" alt="">
    </div>

    <h1>
      <?= $currentProject['title'] ?>
    </h1>

    <p class="description">
      <?= $currentProject['content'] ?>
    </p>

    <div class="technologies">

      <h3>
        التقنيات المستخدمة
      </h3>

      <p>
        <?= $currentProject['technologies'] ?>
      </p>

    </div>

    <a href="index.php" class="back-btn">
      العودة للرئيسية
    </a>

  </div>

</section>

</body>
</html>