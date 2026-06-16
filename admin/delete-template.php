<?php

session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}

require_once '../config/db.php';

$id = $_GET['id'] ?? 0;

$stmt = $pdo->prepare("SELECT * FROM templates WHERE id = ?");
$stmt->execute([$id]);
$template = $stmt->fetch();

if($template){

    if(file_exists("../" . $template['image'])){
        unlink("../" . $template['image']);
    }

    $delete = $pdo->prepare("DELETE FROM templates WHERE id = ?");
    $delete->execute([$id]);
}

header("Location: dashboard.php");
exit;