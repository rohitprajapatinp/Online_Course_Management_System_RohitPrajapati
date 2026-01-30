<?php
include "../includes/header.php";

if (!isset($_GET['id'])) {
    die("Course ID missing");
}

$id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM courses WHERE id = ?");
$stmt->execute([$id]);

header("Location: index.php");
exit;
