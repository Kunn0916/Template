<?php
require('database.php');

$query = "SELECT * FROM teacher";
$sqlAccounts = mysqli_query($connection, $query);

if (!$sqlAccounts) {
    die("Query Failed: " . mysqli_error($connection));
}
?>