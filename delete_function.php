<?php

include 'conn.php';
$my_data = $_GET['cd'];

if (isset($_GET['confirm'])) {
    $delete_query = $conn->query("DELETE FROM `tbl_student` WHERE `stud_id` = '$my_data'");

    if ($delete_query) {
        echo "
        <script>
            window.alert('Successfully Deleted!');
            window.location.href = 'index.php';
        </script>
        ";
    } else {
        echo "
        <script>
            window.alert('Error');
            window.location.href = 'index.php';
        </script>
        ";
    }
} else {
    echo "
    <script>
        var confirmed = confirm('Are you sure you want to delete this record?');
        if (confirmed) {
            window.location.href = 'delete_function.php?cd=$my_data&confirm=true';
        } else {
            window.location.href = 'index.php';
        }
    </script>
    ";
}

?>


<?php
/* 
include 'conn.php';
$my_data = $_GET['cd'];

if (isset($_GET['confirm'])) {
    $delete_query = $conn->query("DELETE FROM `tbl_student` WHERE `stud_id` = '$my_data'");

    if ($delete_query) {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var modal = document.getElementById('successModal');
                var modalInstance = M.Modal.init(modal);
                modalInstance.open();
            });
        </script>
        ";
    } else {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var modal = document.getElementById('errorModal');
                var modalInstance = M.Modal.init(modal);
                modalInstance.open();
            });
        </script>
        ";
    }
} else {
    echo "
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var confirmModal = document.getElementById('confirmModal');
            var confirmModalInstance = M.Modal.init(confirmModal);
            confirmModalInstance.open();
        });
        
        function deleteRecord() {
            window.location.href = 'delete.php?cd=$my_data&confirm=true';
        }
        
        function cancelDelete() {
            window.location.href = 'index.php';
        }
    </script>
    ";
} */
?>
