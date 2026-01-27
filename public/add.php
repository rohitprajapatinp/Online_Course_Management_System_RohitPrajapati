<?php
require "../config/db.php";
require "../includes/header.php";

$con = dbConnect();

$instructors = $con->query("SELECT * FROM instructors")->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['submit'])) {

    $title = trim($_POST['title']);
    $category = trim($_POST['category']);
    $level = trim($_POST['level']);

    $instructor_id = !empty($_POST['instructor_id']) ? $_POST['instructor_id'] : null;

    $sql = "INSERT INTO courses (title, category, level, instructor_id)
            VALUES (?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->execute([$title, $category, $level, $instructor_id]);

    header("Location: index.php");
    exit;
}
?>

<div class="container">

    <h2>Add New Course</h2>

    <form method="POST">
        
        <label>Title:</label>
        <input type="text" name="title" required>

        <label>Category:</label>
        <input type="text" name="category" required>

        <label>Level:</label>
        <select name="level">
            <option value="">-- Select Level --</option>
            <option value="Beginner">Beginner</option>
            <option value="Intermediate">Intermediate</option>
            <option value="Advanced">Advanced</option>
        </select>

        <label>Instructor:</label>
        <select name="instructor_id">
            <option value="">-- Select Instructor --</option>
            <?php foreach ($instructors as $instructor): ?>
                <option value="<?= $instructor['id']; ?>">
                    <?= htmlspecialchars($instructor['name']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <input type="submit" name="submit" value="Add Course">

    </form>

</div>

<?php require "../includes/footer.php"; ?>
