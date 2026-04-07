<?php 
require('database.php');

$teacher_idValue = '';
$first_nameValue = '';
$last_nameValue = '';
$subjectValue = '';
$message = '';

if (isset($_POST['update_submit'])) {
    $teacher_idValue = $_POST['teacher_id'] ?? '';
    $first_nameValue = $_POST['first_name'] ?? '';
    $last_nameValue = $_POST['last_name'] ?? '';
    $subjectValue = $_POST['subject'] ?? '';

    // Validate fields
    if ($first_nameValue == '' || $last_nameValue == '' || $subjectValue == '') {
        $message = 'All fields are required.';
    } else {
        // Use prepared statements for safety
        $queryUpdate = "UPDATE teacher 
                        SET first_name = ?, last_name = ?, subject = ?
                        WHERE teacher_id = ?";
        $stmt = mysqli_prepare($connection, $queryUpdate);
        if (!$stmt) {
            die("Prepare Failed: " . mysqli_error($connection));
        }

        mysqli_stmt_bind_param($stmt, "sssi", $first_nameValue, $last_nameValue, $subjectValue, $teacher_idValue);
        $sqlUpdate = mysqli_stmt_execute($stmt);

        if (!$sqlUpdate) {
            die("Update Failed: " . mysqli_error($connection));
        }

        mysqli_stmt_close($stmt);

        echo '<script>alert("Teacher Updated Successfully")</script>';
        echo '<script>window.location.href = "index.php"</script>';
        exit;
    }
}

elseif (isset($_POST['teacher_id'])) {
    $teacher_idValue = $_POST['teacher_id'];
    $querySelect = "SELECT * FROM teacher WHERE teacher_id = ? LIMIT 1";
    $stmt = mysqli_prepare($connection, $querySelect);
    if (!$stmt) die("Prepare Failed: " . mysqli_error($connection));

    mysqli_stmt_bind_param($stmt, "i", $teacher_idValue);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $first_nameValue = $row['first_name'];
        $last_nameValue = $row['last_name'];
        $subjectValue = $row['subject'];
    } else {
        $message = 'Teacher not found.';
    }

    mysqli_stmt_close($stmt);
} else {
    $message = 'Missing teacher ID.';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Teacher</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="main">
        <form class="create-main" action="update.php" method="post">
            <h3>UPDATE TEACHER</h3>
            <?php if ($message != '') { ?>
                <p><?php echo $message; ?></p>
            <?php } ?>

            <input type="hidden" name="teacher_id" value="<?php echo $teacher_idValue; ?>">

            <input type="text" name="first_name" placeholder="First Name" value="<?php echo $first_nameValue; ?>" required>
            <input type="text" name="last_name" placeholder="Last Name" value="<?php echo $last_nameValue; ?>" required>
            <input type="text" name="subject" placeholder="Subject" value="<?php echo $subjectValue; ?>" required>

            <input type="submit" name="update_submit" value="Update Teacher">
        </form>
    </div>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>