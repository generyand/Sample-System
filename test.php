<?php

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
            window.location.href = 'delete_function.php?cd=$my_data&confirm=true';
        }
        
        function cancelDelete() {
            window.location.href = 'index.php';
        }
    </script>
    ";
}
?>
