<?php
require "../config/db.php";

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$con = dbConnect();
$id = (int) $_GET['id'];

$sql = "DELETE FROM courses WHERE id = ?";
$stmt = $con->prepare($sql);
$stmt->execute([$id]);

header("Location: index.php");
exit;
