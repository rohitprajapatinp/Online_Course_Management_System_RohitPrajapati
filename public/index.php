<?php
require "../config/db.php";
require "../includes/header.php";

$con = dbConnect();

$search = isset($_GET['search']) ? trim($_GET['search']) : "";

if ($search !== "") {
    $sql = "
        SELECT courses.*, instructors.name AS instructor_name
        FROM courses
        LEFT JOIN instructors ON courses.instructor_id = instructors.id
        WHERE 
            courses.title LIKE :search
            OR courses.category LIKE :search
            OR courses.level LIKE :search
            OR instructors.name LIKE :search
    ";
    $stmt = $con->prepare($sql);
    $stmt->execute(['search' => "%$search%"]);
} else {
    $sql = "
        SELECT courses.*, instructors.name AS instructor_name
        FROM courses
        LEFT JOIN instructors ON courses.instructor_id = instructors.id
    ";
    $stmt = $con->prepare($sql);
    $stmt->execute();
}

$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">

    <h2>Course List</h2>

    <form method="GET" class="search" style="margin-bottom:15px;">
    <input type="text" name="search"
           placeholder="Search by title, category, level, instructor"
           value="<?= htmlspecialchars($search); ?>">

    <input type="submit" value="Search" class="btn">
    <a href="index.php" class="btn">Reset</a>
    </form>


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
                        <a href="delete.php?id=<?= $course['id']; ?>"
                           class="btn delete"
                           onclick="return confirm('Are you sure you want to delete this course?');">
                           Delete
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" style="text-align:center;">
                    No courses found
                </td>
            </tr>
        <?php endif; ?>

        </tbody>
    </table>

</div>

<?php require "../includes/footer.php"; ?>
