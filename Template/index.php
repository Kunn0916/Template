<?php 
    require('read.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="main">

    <a href="dashboard.php" class="back-btn">← Back to Dashboard</a>

    <form class="create-main" action ="create.php" method="post">
        <h3>ADD TEACHER</h3>
        ...

    <div class="main">
        <form class="create-main" action ="create.php" method="post">
            <h3>ADD TEACHER</h3>
            <input type="text" name="first_name" placeholder="First Name" required>
            <input type="text" name="last_name" placeholder="Last Name" required>
            <input type="text" name="subject" placeholder="Subject" required>
            <input type="submit" name="create" value="Add Teacher">
        </form>

        <table class="read-main">
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Subject</th>
                <th>Address</th>
            </tr>
            <?php while($results = mysqli_fetch_assoc($sqlAccounts)) {?>
            <tr>
                <td><?php echo $results['teacher_id']?></td>
                <td><?php echo $results['first_name']?></td>
                <td><?php echo $results['last_name']?></td>
                <td><?php echo $results['subject']?></td>
                <td>
                    <form action="delete.php" method="post">
                        <input type="hidden" name="teacher_id" value="<?php echo $results['teacher_id']?>">
                        <input type="submit" name="delete" value="Delete Data">
                    </form>
                    <form action="update.php" method="post">
                        <input type="hidden" name="teacher_id" value="<?php echo $results['teacher_id']?>">
                        <input type="submit" name="update" value="Update Data">
                    </form>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
    
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
