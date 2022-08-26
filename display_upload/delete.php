<?php

include('connect.php');
if (isset($_POST['delete'])) {
    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
    $mission_to_confirm = mysqli_real_escape_string($conn, $_POST['mission_to_confirm']);
    print($id_to_delete);
     //本地刪除未通過的
     $sql = "DELETE FROM imgupload WHERE stu_id = '$id_to_delete' AND mission_name = '$mission_to_confirm'";
     //要顯示的設為未通過
     $sql2 = "UPDATE mission_confirm SET pass = 'not pass' WHERE mstu_id = '$id_to_delete' AND mission_name = '$mission_to_confirm' ";
    if (mysqli_query($conn, $sql) && mysqli_query($conn, $sql2)) {
        //success
        header('Location:upload.php');
     } else {
         //fail
         echo 'query error: ' . mysqli_error($conn);
     }
}

?>