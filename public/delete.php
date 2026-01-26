<?php
require "../config/db.php";

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$con = dbConnect();
$id = (int) $_GET['id'];

$stmt = $con->prepare("DELETE FROM courses WHERE id = ?");
$stmt->execute([$id]);

header("Location: index.php");
exit;
