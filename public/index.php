<?php
require "../config/db.php";
require "../includes/header.php";

$con = dbConnect();

$sql = "
    SELECT courses.*, instructors.name AS instructor_name
    FROM courses
    LEFT JOIN instructors ON courses.instructor_id = instructors.id
";

$stmt = $con->prepare($sql);
$stmt->execute();
$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Course List</h2>

<a href="add.php">Add New Course</a>
<br><br>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Category</th>
        <th>Level</th>
        <th>Instructor</th>
        <th>Action</th>
    </tr>

    <?php foreach ($courses as $course): ?>
        <tr>
            <td><?= $course['id']; ?></td>
            <td><?= htmlspecialchars($course['title']); ?></td>
            <td><?= htmlspecialchars($course['category']); ?></td>
            <td><?= htmlspecialchars($course['level']); ?></td>
            <td><?= htmlspecialchars($course['instructor_name'] ?? '—'); ?></td>
            <td>
                <a href="edit.php?id=<?= $course['id']; ?>">Edit</a> |
                <a href="delete.php?id=<?= $course['id']; ?>"
                   onclick="return confirm('Are you sure you want to delete this course?');">
                   Delete
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php require "../includes/footer.php"; ?>
