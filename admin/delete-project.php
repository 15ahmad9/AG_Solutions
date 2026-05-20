<?php

session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}

require_once '../config/db.php';

$id = $_GET['id'] ?? 0;

$stmt = $pdo->prepare("
    DELETE FROM projects
    WHERE id = ?
");

$stmt->execute([$id]);

header("Location: dashboard.php");

exit;

?>