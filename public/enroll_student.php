<?php
include "../includes/header.php";

$students = $pdo->query("SELECT * FROM students")->fetchAll();

$courses = $pdo->query("SELECT * FROM courses")->fetchAll();

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $student_id = $_POST['student_id'];
    $course_id = $_POST['course_id'];

    if ($student_id === "" || $course_id === "") {
        $message = "Please select student and course.";
    } else {
        $stmt = $pdo->prepare(
            "INSERT INTO enrollments (student_id, course_id)
             VALUES (?, ?)"
        );
        $stmt->execute([$student_id, $course_id]);

        $message = "Student enrolled successfully!";
    }
}
?>

<h3>Enroll Student</h3>

<?php if ($message): ?>
    <p style="color:green;"><?= escape($message) ?></p>
<?php endif; ?>

<form method="post">

    <label>Student:</label><br>
    <select name="student_id" required>
        <option value="">-- Select Student --</option>
        <?php foreach ($students as $student): ?>
            <option value="<?= $student['id'] ?>">
                <?= escape($student['name']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Course:</label><br>
    <select name="course_id" required>
        <option value="">-- Select Course --</option>
        <?php foreach ($courses as $course): ?>
            <option value="<?= $course['id'] ?>">
                <?= escape($course['title']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit">Enroll</button>
</form>

<br>

<?php include "../includes/footer.php"; ?>
