<?php 
$servername = 'localhost';
$user = 'root';
$password = '';
$database = 'students_db';

$connection = mysqli_connect($servername, $user, $password, $database);
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

?>