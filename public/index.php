<?php
include "../includes/header.php";

$stmt = $pdo->query(
    "SELECT courses.*, instructors.name AS instructor_name
     FROM courses
     LEFT JOIN instructors ON courses.instructor_id = instructors.id"
);
?>

<h3>All Courses</h3>

<table border="1" cellpadding="8">
    <tr>
        <th>Title</th>
        <th>Category</th>
        <th>Level</th>
        <th>Instructor</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($stmt as $course): ?>
        <tr>
            <td><?= escape($course['title']) ?></td>
            <td><?= escape($course['category']) ?></td>
            <td><?= escape($course['level']) ?></td>
            <td><?= escape($course['instructor_name']) ?></td>
            <td>
                <form method="get" action="edit_course.php" class="inline-form" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $course['id'] ?>">
                    <button type="submit" class="table-link">Edit</button>
                </form>
                |
                <form method="post" action="delete_course.php" class="inline-form" style="display:inline;"
                      onsubmit="return confirm('Are you sure you want to delete this course?')">
                    <input type="hidden" name="id" value="<?= $course['id'] ?>">
                    <input type="hidden" name="csrf_token" value="<?= generateCSRFToken() ?>">
                    <button type="submit" class="table-link">Delete</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php include "../includes/footer.php"; ?>