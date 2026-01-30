<?php
require_once __DIR__ . "/../config/db.php";
require_once __DIR__ . "/functions.php";

$currentPage = basename($_SERVER['PHP_SELF']);

if (!isLoggedIn() && $currentPage !== "login.php") {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Online Course Management System</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<h2>Online Course Management System</h2>

<nav>
    <a href="index.php">Home</a> |
    <a href="add_course.php">Add Course</a> |
    <a href="search.php">Search</a> |
    <a href="logout.php">Logout</a>
</nav>

<hr>
