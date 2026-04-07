<?php
    require('database.php');

    if (isset($_POST['delete'])) {
        $teacher_id = $_POST['teacher_id'] ?? '';

        if ($teacher_id === '' || !ctype_digit((string)$teacher_id)) {
            die("Delete Failed: Missing or invalid teacher ID.");
        }
        $teacher_id = (int)$teacher_id;
        
        $queryDelete = "DELETE FROM teacher WHERE teacher_id = ?";
        $stmt = mysqli_prepare($connection, $queryDelete);
        mysqli_stmt_bind_param($stmt, "i", $teacher_id);
        $sqlDelete = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        if (!$sqlDelete) {
            die("Delete Failed: " . mysqli_error($connection));
        }

        echo '<script>alert("Teacher Data Deleted Successfully")</script>';
        echo '<script>window.location.href = "index.php"</script>';
    }
?>
 
