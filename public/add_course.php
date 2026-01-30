<?php
include "../includes/header.php";

$csrfToken = generateCSRFToken();

$instructors = $pdo->query("SELECT * FROM instructors")->fetchAll();

$error = "";

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
            "INSERT INTO courses (title, category, level, instructor_id)
             VALUES (?, ?, ?, ?)"
        );
        $stmt->execute([$title, $category, $level, $instructor_id]);
        header("Location: index.php");
        exit;
    }
}
?>

<h3>Add Course</h3>

<?php if ($error): ?>
    <p style="color:red;"><?= escape($error) ?></p>
<?php endif; ?>

<form method="post">
    <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">

    <label>Course Title:</label><br>
    <input type="text" name="title" required><br><br>

    <label>Category:</label><br>
    <input type="text" name="category" required><br><br>

    <label>Level:</label><br>
    <input type="text" name="level" required><br><br>

    <label>Instructor:</label><br>
    <select name="instructor_id" required>
        <?php foreach ($instructors as $inst): ?>
            <option value="<?= $inst['id'] ?>">
                <?= escape($inst['name']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit">Add Course</button>
</form>

<?php include "../includes/footer.php"; ?>
