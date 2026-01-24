<?php
require "../config/db.php";
require "../includes/header.php";

$con = dbConnect();

$stmt = $con->prepare("SELECT * FROM courses");
$stmt->execute();
$courses = $stmt->fetchAll();
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
            <td><?php echo $course['id']; ?></td>
            <td><?php echo htmlspecialchars($course['title']); ?></td>
            <td><?php echo htmlspecialchars($course['category']); ?></td>
            <td><?php echo htmlspecialchars($course['level']); ?></td>
            <td><?php echo htmlspecialchars($course['instructor']); ?></td>
            <td>
                <a href="edit.php?id=<?php echo $course['id']; ?>">Edit</a> |
                <a href="delete.php?id=<?php echo $course['id']; ?>">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php require "../includes/footer.php"; ?>
