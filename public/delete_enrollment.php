<?php
include "../includes/header.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Invalid request");
}

if (!verifyCSRFToken($_POST['csrf_token'])) {
    die("Invalid CSRF token");
}

if (!isset($_POST['id'])) {
    die("Enrollment ID missing");
}

$id = $_POST['id'];

$stmt = $pdo->prepare("DELETE FROM enrollments WHERE id = ?");
$stmt->execute([$id]);

header("Location: view_enrollments.php");
exit;
