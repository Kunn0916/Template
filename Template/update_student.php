<?php
require('database.php');

$student_idValue = '';
$first_nameValue = '';
$last_nameValue = '';
$teacher_idValue = '';
$message = '';

$queryTeachers = "SELECT teacher_id, first_name, last_name FROM teacher ORDER BY teacher_id DESC";
$sqlTeachers = mysqli_query($connection, $queryTeachers);
if (!$sqlTeachers) {
    die("Teacher Read Failed: " . mysqli_error($connection));
}

if (isset($_POST['update_submit'])) {
    $student_idValue = $_POST['student_id'] ?? '';
    $first_nameValue = $_POST['first_name'] ?? '';
    $last_nameValue = $_POST['last_name'] ?? '';
    $teacher_idValue = $_POST['teacher_id'] ?? '';

    if ($student_idValue === '' || !ctype_digit((string)$student_idValue)) {
        $message = 'Missing or invalid student ID.';
    } elseif ($first_nameValue === '' || $last_nameValue === '' || $teacher_idValue === '' || !ctype_digit((string)$teacher_idValue)) {
        $message = 'All fields are required.';
    } else {
        $student_idValue = (int)$student_idValue;
        $teacher_idValue = (int)$teacher_idValue;

        $queryUpdate = "UPDATE student SET first_name = ?, last_name = ?, teacher_id = ? WHERE student_id = ?";
        $stmt = mysqli_prepare($connection, $queryUpdate);
        if (!$stmt) {
            die("Prepare Failed: " . mysqli_error($connection));
        }

        mysqli_stmt_bind_param($stmt, "ssii", $first_nameValue, $last_nameValue, $teacher_idValue, $student_idValue);
        $sqlUpdate = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        if (!$sqlUpdate) {
            die("Update Failed: " . mysqli_error($connection));
        }

        echo '<script>alert("Student Updated Successfully")</script>';
        echo '<script>window.location.href = "student_index.php"</script>';
        exit;
    }
} elseif (isset($_POST['student_id'])) {
    $student_idValue = $_POST['student_id'];
    $querySelect = "SELECT * FROM student WHERE student_id = ? LIMIT 1";
    $stmt = mysqli_prepare($connection, $querySelect);
    if (!$stmt) {
        die("Prepare Failed: " . mysqli_error($connection));
    }

    mysqli_stmt_bind_param($stmt, "i", $student_idValue);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $first_nameValue = $row['first_name'];
        $last_nameValue = $row['last_name'];
        $teacher_idValue = $row['teacher_id'];
    } else {
        $message = 'Student not found.';
    }

    mysqli_stmt_close($stmt);
} else {
    $message = 'Missing student ID.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="main">
        <form class="create-main" action="update_student.php" method="post">
            <h3>UPDATE STUDENT</h3>
            <?php if ($message != '') { ?>
                <p><?php echo $message; ?></p>
            <?php } ?>

            <input type="hidden" name="student_id" value="<?php echo $student_idValue; ?>">

            <input type="text" name="first_name" placeholder="First Name" value="<?php echo $first_nameValue; ?>" required>
            <input type="text" name="last_name" placeholder="Last Name" value="<?php echo $last_nameValue; ?>" required>
            <select name="teacher_id" required>
                <option value="">Select Teacher</option>
                <?php while($t = mysqli_fetch_assoc($sqlTeachers)) { ?>
                    <?php $selected = ((string)$t['teacher_id'] === (string)$teacher_idValue) ? 'selected' : ''; ?>
                    <option value="<?php echo $t['teacher_id']; ?>" <?php echo $selected; ?>>
                        <?php echo $t['first_name'] . ' ' . $t['last_name']; ?>
                    </option>
                <?php } ?>
            </select>

            <input type="submit" name="update_submit" value="Update Student">
        </form>
    </div>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
