<!-- <?php
include "../includes/header.php";

$stmt = $pdo->query(
    "SELECT enrollments.id,students.name AS student_name,
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
        <th>Actions</th>
    </tr>

    <?php foreach ($stmt as $row): ?>
        <tr>
            <td><?= escape($row['student_name']) ?></td>
            <td><?= escape($row['course_title']) ?></td>
            <td>
                <form method="post" action="delete_enrollment.php" style="display:inline;"
                      onsubmit="return confirm('Are you sure you want to unenroll this student?')">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <input type="hidden" name="csrf_token" value="<?= generateCSRFToken() ?>">
                    <button type="submit" class="button-link">Unenroll</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php include "../includes/footer.php"; ?>
 -->



<?php
include "../includes/header.php";

$stmt = $pdo->query(
    "SELECT enrollments.id, students.name AS student_name,
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
        <th>Actions</th>
    </tr>

    <?php foreach ($stmt as $row): ?>
        <tr>
            <td><?= escape($row['student_name']) ?></td>
            <td><?= escape($row['course_title']) ?></td>
            <td>
                <form method="post" action="delete_enrollment.php" class="inline-form"
                      onsubmit="return confirm('Are you sure you want to unenroll this student?')">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <input type="hidden" name="csrf_token" value="<?= generateCSRFToken() ?>">
                    <button type="submit" class="table-link">Unenroll</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php include "../includes/footer.php"; ?>
