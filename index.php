<?php
include("conn.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sample System</title>
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="script.js" defer></script>
</head>

<body>

    <div class="sample-system">

        <?php
        if (isset($_POST['btn_insert'])) {
            $student_name = $_POST['txt_name'];
            $student_course = $_POST['txt_course'];

            $sql = $conn->query("INSERT INTO `tbl_student` values(NULL, '$student_name', '$student_course')");

            if ($sql) {
                echo
                "<script>
                window.alert('Successfully added to Database');
                </script>
                ";
            }
        }
        ?>

        <div class="nav">
            <a id="insert" class="nav-links insert-nav active" href="#">Insert</a>
            <a id="retrieve" class="nav-links retrieve-nav" href="#">Retrieve</a>
            <a id="search" class="nav-links search-nav " href="#">Search</a>
        </div>


        <!-- INSERTING DATA TO DATABASE -->
        <div class="crud insert insert-data | box-shadow border-radius">
            <h1 class="primary-heading">INSERT DATA TO DATABASE</h1>
            <form method="POST" class="main-padding gap-24 fs-small">
                <input type="text" name="txt_name" placeholder="Name" required>
                <input type="text" name="txt_course" placeholder="Course" required>
                <input type="submit" name="btn_insert" value="INSERT">
            </form>

            <?php
            if (isset($_POST['btn_retrieve'])) {
                $id = $_POST['txt_retrieve'];

                $ret = $conn->query("SELECT * FROM `tbl_student` WHERE `stud_id` = '$id';");
                $row = $ret->fetch_array();
            }
            ?>
        </div>


        <!-- RETRIEVING DATA FROM DATABASE -->
        <div class="crud retrieve retrieve-data | gap-48 display-none">
            <div class="retrieve-data | box-shadow border-radius">
                <h1 class="primary-heading">RETRIEVE DATA FROM DATABASE</h1>
                <form method="POST" class="main-padding gap-24 fs-small">
                    <input type="text" name="txt_retrieve" placeholder="Enter Student ID" required>
                    <input type="submit" name="btn_retrieve" value="RETRIEVE">
                </form>
            </div>

            <div class="display-data border-radius box-shadow fs-small">
                <h2 class="secondary-heading">DISPLAY DATA HERE</h2>
                <div class="display-data-main main-padding gap-16">
                    <div class="output-wrapper">
                        <p class="fw-bold">ID: <span class="fw-regular"><?php echo @$row['stud_id'] ?></span></p>
                        <hr>
                    </div>
                    <div class="output-wrapper">
                        <p class="fw-bold">Name: <span class="fw-regular"><?php echo @$row['student_name'] ?></span></p>
                        <hr>
                    </div>
                    <div class="output-wrapper">
                        <p class="fw-bold">Course: <span class="fw-regular"><?php echo @$row['student_course'] ?></span></p>
                        <hr>
                    </div>
                </div>
            </div>
        </div>

        <!-- SEARCHING DATA FROM DATABASE -->
        <div class="crud search search-data | border-radius gap-24 display-none">
            <div class="search-data-main | box-shadow">
                <h1 class="primary-heading">SEARCH DATA FROM DATABASE</h1>
                <form action="" method="post" class="main-padding gap-24 fs-small">
                    <div class="search-wrapper">
                        <label for="txt_search">Enter the ID, Name, or Course of the Student</label>
                        <input type="text" id="txt_search" name="txt_search">
                    </div>
                    <input type="submit" value="SEARCH" name="btn_search">
                </form>
            </div>

            <table class="table | box-shadow border-radius">

                <div class="table-header">
                    <thead class="thead">
                        <tr>
                            <th class="id">ID</th>
                            <!-- <hr> -->
                            <th class="name">Name</th>
                            <th class="course">Course</th>
                        </tr>
                    </thead>
                </div>


                <tbody>
                    <?php
                    if (isset($_POST['btn_search'])) {
                        $search_txt = $_POST['txt_search'];
                        $ret2 = $conn->query("SELECT * FROM `tbl_student` 
                                        WHERE CONCAT(`stud_id`, `student_name`, `student_course`) 
                                        LIKE '%$search_txt%'");

                        while ($fetch_d = $ret2->fetch_array()) {
                    ?>
                            <tr>
                                <td> <?php echo $fetch_d['stud_id']; ?></td>
                                <td> <?php echo $fetch_d['student_name']; ?></td>
                                <td> <?php echo $fetch_d['student_course']; ?></td>
                                <td><a href="edit_page.php?id=<?php echo $fetch_d['stud_id']; ?>"><button type="button" name="edit">Edit</button></a></td>

                                <!-- DELETE FORM -->
                                <form action="delete_function.php?cd=<?php echo $fetch_d['stud_id']; ?>" method="post" encytype="mltipart/form-data"> <!-- You can't edit this because it uses method post. Or just try maybe you can. You can :D -->
                                    <td>
                                        <button type="submit" name="delete">Delete</button>
                                    </td>
                                </form>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>

            </table>
        </div>


    </div>


    <!-- Confirm Modal
    <div id="confirmModal" class="modal">
        <div class="modal-content">
            <h4>Confirm Delete</h4>
            <p>Are you sure you want to delete this record?</p>
        </div>
        <div class="modal-footer">
            <a href="#" class="modal-close waves-effect waves-green btn-flat" onclick="deleteRecord()">Delete</a>
            <a href="#" class="modal-close waves-effect waves-red btn-flat" onclick="cancelDelete()">Cancel</a>
        </div>
    </div>

    Success Modal 
    <div id="successModal" class="modal">
        <div class="modal-content">
            <h4>Success</h4>
            <p>Successfully Deleted!</p>
        </div>
        <div class="modal-footer">
            <a href="index.php" class="modal-close waves-effect waves-green btn-flat">OK</a>
        </div>
    </div>

    Error Modal 
    <div id="errorModal" class="modal">
        <div class="modal-content">
            <h4>Error</h4>
            <p>Error occurred while deleting the record.</p>
        </div>
        <div class="modal-footer">
            <a href="index.php" class="modal-close waves-effect waves-green btn-flat">OK</a>
        </div>
    </div> -->


</body>

</html>