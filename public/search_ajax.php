<?php
require_once "../config/db.php";
require_once "../includes/functions.php";

$q = $_GET['q'] ?? '';

if ($q) {
    $stmt = $pdo->prepare(
        "SELECT courses.*, instructors.name AS instructor_name
         FROM courses
         LEFT JOIN instructors ON courses.instructor_id = instructors.id
         WHERE courses.title LIKE ? OR courses.category LIKE ? OR courses.level LIKE ?"
    );
    $like = "%$q%";
    $stmt->execute([$like, $like, $like]);
} else {
    $stmt = $pdo->query(
        "SELECT courses.*, instructors.name AS instructor_name
         FROM courses
         LEFT JOIN instructors ON courses.instructor_id = instructors.id"
    );
}

$courses = $stmt->fetchAll();

if ($courses) {
    foreach ($courses as $course) {
        echo "<tr>";
        echo "<td>" . escape($course['title']) . "</td>";
        echo "<td>" . escape($course['category']) . "</td>";
        echo "<td>" . escape($course['level']) . "</td>";
        echo "<td>" . escape($course['instructor_name']) . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>No courses found</td></tr>";
}
