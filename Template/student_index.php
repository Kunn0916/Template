<?php 
    require('read_student.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Manager</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="main">
    <a href="dashboard.php" class="back-btn">&#8592; Back to Dashboard</a>

    <form class="create-main" action="create_student.php" method="post">
            <h3>ADD STUDENT</h3>
            <input type="text" name="first_name" placeholder="First Name" required>
            <input type="text" name="last_name" placeholder="Last Name" required>
            <select name="teacher_id" required>
<option value="">Select Teacher</option>
                <?php while($t = mysqli_fetch_assoc($sqlTeachers)) { ?>
                    <option value="<?php echo $t['teacher_id']; ?>">
                        <?php echo $t['first_name'] . ' ' . $t['last_name']; ?>
                    </option>
                <?php } ?>
            </select>
            <input type="submit" name="create" value="Add Student">
        </form>

        <table class="read-main">
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Teacher</th>
                <th>Actions</th>
            </tr>
            <?php while($s = mysqli_fetch_assoc($sqlStudents)) {?>
            <tr>
                <td><?php echo $s['student_id']; ?></td>
                <td><?php echo $s['first_name']; ?></td>
                <td><?php echo $s['last_name']; ?></td>
                <td>
<?php
                        $teacherName = trim(($s['teacher_first_name'] ?? '') . ' ' . ($s['teacher_last_name'] ?? ''));
                        echo $teacherName !== '' ? $teacherName : 'Unassigned';
                    ?>
</td>
                <td>
                    <form action="delete_student.php" method="post">
                        <input type="hidden" name="student_id" value="<?php echo $s['student_id']; ?>">
                        <input type="submit" name="delete" value="Delete Student">
                    </form>
                    <form action="update_student.php" method="post">
                        <input type="hidden" name="student_id" value="<?php echo $s['student_id']; ?>">
                        <input type="submit" name="update" value="Update Student">
                    </form>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
    
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
