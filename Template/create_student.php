<?php
require('database.php');

if (isset($_POST['create'])) {
    $first_name = $_POST['first_name'] ?? '';
    $last_name = $_POST['last_name'] ?? '';
    $teacher_id = $_POST['teacher_id'] ?? '';

    if ($first_name === '' || $last_name === '' || $teacher_id === '' || !ctype_digit((string)$teacher_id)) {
        die("Missing or invalid fields.");
    }

    $teacher_id = (int)$teacher_id;

    $queryCreate = "INSERT INTO student (first_name, last_name, teacher_id) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($connection, $queryCreate);
    if (!$stmt) {
        die("Prepare Failed: " . mysqli_error($connection));
    }

    mysqli_stmt_bind_param($stmt, "ssi", $first_name, $last_name, $teacher_id);
    $sqlCreate = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    if (!$sqlCreate) {
        die("Execute Failed: " . mysqli_error($connection));
    }

    echo '<script>alert("Student Created Successfully")</script>';
    echo '<script>window.location.href = "student_index.php"</script>';
}
?>
