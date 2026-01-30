<?php
include "../includes/header.php";

$category = $_GET['category'] ?? '';
$level = $_GET['level'] ?? '';
$instructor = $_GET['instructor'] ?? '';

$query = "
    SELECT courses.*, instructors.name AS instructor_name
    FROM courses
    LEFT JOIN instructors ON courses.instructor_id = instructors.id
    WHERE 1
";

$params = [];

if ($category !== '') {
    $query .= " AND courses.category LIKE ?";
    $params[] = "%$category%";
}

if ($level !== '') {
    $query .= " AND courses.level LIKE ?";
    $params[] = "%$level%";
}

if ($instructor !== '') {
    $query .= " AND instructors.name LIKE ?";
    $params[] = "%$instructor%";
}

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$results = $stmt->fetchAll();
?>

<h3>Search Courses (Normal)</h3>

<form method="get">
    Category:
    <input type="text" name="category" value="<?= escape($category) ?>">

    Level:
    <input type="text" name="level" value="<?= escape($level) ?>">

    Instructor:
    <input type="text" name="instructor" value="<?= escape($instructor) ?>">

    <button type="submit">Search</button>
</form>

<br>

<table border="1" cellpadding="8">
    <tr>
        <th>Title</th>
        <th>Category</th>
        <th>Level</th>
        <th>Instructor</th>
    </tr>

    <?php foreach ($results as $course): ?>
        <tr>
            <td><?= escape($course['title']) ?></td>
            <td><?= escape($course['category']) ?></td>
            <td><?= escape($course['level']) ?></td>
            <td><?= escape($course['instructor_name']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<hr>

<h3>Live Course Search (Ajax)</h3>

<input type="text" id="search-box" placeholder="Type course title, category, or level...">

<table border="1" cellpadding="8">
    <thead>
        <tr>
            <th>Title</th>
            <th>Category</th>
            <th>Level</th>
            <th>Instructor</th>
        </tr>
    </thead>
    <tbody id="course-table-body">
    </tbody>
</table>

<script src="../assets/js/ajax.js"></script>

<?php include "../includes/footer.php"; ?>
