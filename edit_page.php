<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'conn.php';
$get_data = $_GET['id'];
$get_info = $conn->query("SELECT * FROM `tbl_student` WHERE `stud_id` = '$get_data'");
$info_row = $get_info->fetch_array();
$new_id = $info_row['stud_id'];

?>

<form action="edit_function.php?cd=<?php echo $new_id;?>" method="POST">
    <h3>Your info</h3>
    <input type="text" name="student_name" value="<?php echo $info_row['student_name'] ?>">
    <input type="text" name="student_course" value="<?php echo $info_row['student_course'] ?>">
    <button type="submit" name="update">Update</button>
</form>