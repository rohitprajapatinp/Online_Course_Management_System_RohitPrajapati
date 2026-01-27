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

<div class="container">

    <h2>Course List</h2>

    <a href="add.php" class="btn">+ Add New Course</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Category</th>
                <th>Level</th>
                <th>Instructor</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php if (count($courses) > 0): ?>
            <?php foreach ($courses as $course): ?>
                <tr>
                    <td><?= $course['id']; ?></td>
                    <td><?= htmlspecialchars($course['title']); ?></td>
                    <td><?= htmlspecialchars($course['category']); ?></td>
                    <td><?= htmlspecialchars(!empty($course['level']) ? $course['level'] : '—'); ?></td>
                    <td><?= htmlspecialchars(!empty($course['instructor_name']) ? $course['instructor_name'] : '—'); ?></td>
                    <td>
                        <a href="edit.php?id=<?= $course['id']; ?>" class="btn edit">Edit</a>
                        <a href="delete.php?id=<?= $course['id']; ?>" class="btn delete"
                           onclick="return confirm('Are you sure you want to delete this course?');">
                           Delete
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" style="text-align:center;">No courses found</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>

</div>

<?php require "../includes/footer.php"; ?>
