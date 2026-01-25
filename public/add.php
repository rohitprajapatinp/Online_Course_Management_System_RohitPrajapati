<?php
require "../config/db.php";
require "../includes/header.php";

$con = dbConnect();

// Fetch all instructors for the dropdown
$instructors = $con->query("SELECT * FROM instructors")->fetchAll();

if (isset($_POST['submit'])) {

    $title = trim($_POST['title']);
    $category = trim($_POST['category']);
    $level = trim($_POST['level']);

    // If instructor_id is empty or invalid, set it to NULL
    $instructor_id = null;
    if (!empty($_POST['instructor_id'])) {
        // Check if this instructor_id exists in the instructors table
        $stmt_check = $con->prepare("SELECT id FROM instructors WHERE id = ?");
        $stmt_check->execute([$_POST['instructor_id']]);
        $valid_instructor = $stmt_check->fetch();
        if ($valid_instructor) {
            $instructor_id = (int) $_POST['instructor_id'];
        }
    }

    // Insert course
    $sql = "INSERT INTO courses (title, category, level, instructor_id)
            VALUES (?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->execute([$title, $category, $level, $instructor_id]);

    header("Location: index.php");
    exit;
}
?>

<h2>Add New Course</h2>

<form method="POST">
    <label>Title:</label><br>
    <input type="text" name="title" required><br><br>

    <label>Category:</label><br>
    <input type="text" name="category"><br><br>

    <label>Level:</label><br>
    <select name="level">
        <option value="">-- Select Level --</option>
        <option value="Beginner">Beginner</option>
        <option value="Intermediate">Intermediate</option>
        <option value="Advanced">Advanced</option>
    </select><br><br>

    <label>Instructor:</label><br>
    <select name="instructor_id">
        <option value="">-- Select Instructor --</option>
        <?php foreach($instructors as $instructor): ?>
            <option value="<?php echo $instructor['id']; ?>">
                <?php echo htmlspecialchars($instructor['name']); ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <input type="submit" name="submit" value="Add Course">
</form>

<?php require "../includes/footer.php"; ?>
