<?php
include "../includes/header.php";

$stmt = $pdo->query(
    "SELECT students.name AS student_name,
            courses.title AS course_title
     FROM enrollments
     JOIN students ON enrollments.student_id = students.id
     JOIN courses ON enrollments.course_id = courses.id"
);
?>

<h3>Student Enrollments</h3>

<table border="1" cellpadding="8">
    <tr>
        <th>Student Name</th>
        <th>Course Title</th>
    </tr>

    <?php foreach ($stmt as $row): ?>
        <tr>
            <td><?= escape($row['student_name']) ?></td>
            <td><?= escape($row['course_title']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<?php include "../includes/footer.php"; ?>
