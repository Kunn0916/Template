<?php
require('database.php');

if (isset($_POST['delete'])) {
    $student_id = $_POST['student_id'] ?? '';

    if ($student_id === '' || !ctype_digit((string)$student_id)) {
        die("Delete Failed: Missing or invalid student ID.");
    }

    $student_id = (int)$student_id;

    $queryDelete = "DELETE FROM student WHERE student_id = ?";
    $stmt = mysqli_prepare($connection, $queryDelete);
    if (!$stmt) {
        die("Prepare Failed: " . mysqli_error($connection));
    }

    mysqli_stmt_bind_param($stmt, "i", $student_id);
    $sqlDelete = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    if (!$sqlDelete) {
        die("Delete Failed: " . mysqli_error($connection));
    }

    echo '<script>alert("Student Deleted Successfully")</script>';
    echo '<script>window.location.href = "student_index.php"</script>';
}
?>
