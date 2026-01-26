<?php
function dbConnect() {
    $server = "mysql:host=localhost;dbname=online_courses_db;charset=utf8mb4";
    $user = "root";
    $password = "";

    try {
        $con = new PDO($server, $user, $password);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $con;
    } catch (PDOException $e) {
        die("Database Connection Failed: " . $e->getMessage());
    }
}
