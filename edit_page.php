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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Page</title>
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="edit-container border-radius box-shadow">
        <h3 class="primary-heading ">YOUR INFO</h3>
        <form class="main-padding gap-24" action="edit_function.php?cd=<?php echo $new_id; ?>" method="POST">
            <div class="search-wrapper gap-24">
                <input type="text" name="student_name" value="<?php echo $info_row['student_name'] ?>">
                <input type="text" name="student_course" value="<?php echo $info_row['student_course'] ?>">
                <button id="update-btn" type="submit" name="update">UPDATE</button>
            </div>
        </form>
    </div>
</body>

</html>
