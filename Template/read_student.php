<?php
require('database.php');

$queryStudents = "SELECT s.student_id, s.first_name, s.last_name, s.teacher_id,
                         t.first_name AS teacher_first_name, t.last_name AS teacher_last_name
                  FROM student s
                  LEFT JOIN teacher t ON s.teacher_id = t.teacher_id
                  ORDER BY s.student_id DESC";
$sqlStudents = mysqli_query($connection, $queryStudents);
if (!$sqlStudents) {
    die("Read Failed: " . mysqli_error($connection));
}

$queryTeachers = "SELECT teacher_id, first_name, last_name FROM teacher ORDER BY teacher_id DESC";
$sqlTeachers = mysqli_query($connection, $queryTeachers);
if (!$sqlTeachers) {
    die("Teacher Read Failed: " . mysqli_error($connection));
}
?>
