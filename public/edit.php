<?php
require "../config/db.php";
require "../includes/header.php";

$con = dbConnect();

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int) $_GET['id'];

// Fetch course
$stmt = $con->prepare("SELECT * FROM courses WHERE id = ?");
$stmt->execute([$id]);
$course = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$course) {
    die("Course not found");
}

// Fetch instructors
$instructors = $con->query("SELECT * FROM instructors")->fetchAll();

if (isset($_POST['submit'])) {
    $title = trim($_POST['title']);
    $category = trim($_POST['category']);
    $level = trim($_POST['level']);
    $instructor_id = !empty($_POST['instructor_id']) ? $_POST['instructor_id'] : null;

    $sql = "UPDATE courses
            SET title = ?, category = ?, level = ?, instructor_id = ?
            WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->execute([$title, $category, $level, $instructor_id, $id]);

    header("Location: index.php");
    exit;
}
?>

<h2>Edit Course</h2>

<form method="POST">
    <label>Title:</label><br>
    <input type="text" name="title" value="<?= htmlspecialchars($course['title']); ?>" required><br><br>

    <label>Category:</label><br>
    <input type="text" name="category" value="<?= htmlspecialchars($course['category']); ?>"><br><br>

    <label>Level:</label><br>
    <select name="level">
        <option value="">-- Select Level --</option>
        <?php foreach (["Beginner","Intermediate","Advanced"] as $lvl): ?>
            <option value="<?= $lvl; ?>" <?= $course['level'] === $lvl ? 'selected' : ''; ?>>
                <?= $lvl; ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Instructor:</label><br>
    <select name="instructor_id">
        <option value="">-- Select Instructor --</option>
        <?php foreach ($instructors as $instructor): ?>
            <option value="<?= $instructor['id']; ?>"
                <?= $course['instructor_id'] == $instructor['id'] ? 'selected' : ''; ?>>
                <?= htmlspecialchars($instructor['name']); ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <input type="submit" name="submit" value="Update Course">
</form>

<?php require "../includes/footer.php"; ?>
