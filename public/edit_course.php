<?php
include "../includes/header.php";

if (!isset($_GET['id'])) {
    die("Course ID missing");
}

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM courses WHERE id = ?");
$stmt->execute([$id]);
$course = $stmt->fetch();

if (!$course) {
    die("Course not found");
}

$instructors = $pdo->query("SELECT * FROM instructors")->fetchAll();

$error = "";
$csrfToken = generateCSRFToken();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (!verifyCSRFToken($_POST['csrf_token'])) {
        die("Invalid CSRF token");
    }

    $title = trim($_POST['title']);
    $category = trim($_POST['category']);
    $level = trim($_POST['level']);
    $instructor_id = $_POST['instructor_id'];

    if ($title === "" || $category === "" || $level === "") {
        $error = "All fields are required.";
    } else {

        $stmt = $pdo->prepare(
            "UPDATE courses
             SET title = ?, category = ?, level = ?, instructor_id = ?
             WHERE id = ?"
        );
        $stmt->execute([$title, $category, $level, $instructor_id, $id]);

        header("Location: index.php");
        exit;
    }
}
?>

<h3>Edit Course</h3>

<?php if ($error): ?>
    <p style="color:red;"><?= escape($error) ?></p>
<?php endif; ?>

<form method="post">
    <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">

    <label>Course Title:</label><br>
    <input type="text" name="title" value="<?= escape($course['title']) ?>" required><br><br>

    <label>Category:</label><br>
    <input type="text" name="category" value="<?= escape($course['category']) ?>" required><br><br>

    <label>Level:</label><br>
    <input type="text" name="level" value="<?= escape($course['level']) ?>" required><br><br>

    <label>Instructor:</label><br>
    <select name="instructor_id">
        <?php foreach ($instructors as $inst): ?>
            <option value="<?= $inst['id'] ?>"
                <?= $inst['id'] == $course['instructor_id'] ? "selected" : "" ?>>
                <?= escape($inst['name']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit">Update Course</button>
</form>

<?php include "../includes/footer.php"; ?>
