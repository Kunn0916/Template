<?php 
    require('database.php');

    if(isset($_POST['create'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $subject = $_POST['subject'];

        if ($subject === '') {
            echo '<script>alert("Subject is missing. Please enter a subject.")</script>';
            echo '<script>window.location.href = "index.php"</script>';
            exit;
        }

        $queryCreate = "INSERT INTO teacher (first_name, last_name, subject) VALUES(?, ?, ?)";
        $stmt = mysqli_prepare($connection, $queryCreate);
        
        if (!$stmt) {
            die("Prepare Failed: " . mysqli_error($connection));
        }

        mysqli_stmt_bind_param($stmt, "sss", $first_name, $last_name, $subject);
        $sqlCreate = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        if (!$sqlCreate) {
            die("Execute Failed: " . mysqli_error($connection));
        }

        echo '<script>alert("Teacher Created Successfully")</script>';
        echo '<script>window.location.href = "index.php"</script>';
    }
?>
