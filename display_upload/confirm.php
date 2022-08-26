<?php
include('connect.php');
if (isset($_POST['confirm'])) {
    $id_to_confirm = mysqli_real_escape_string($conn, $_POST['id_to_confirm']);
    $mission_to_confirm = mysqli_real_escape_string($conn, $_POST['mission_to_confirm']);
    print($id_to_confirm);
     $sql = " UPDATE  mission_confirm SET pass = 'pass' WHERE mstu_id = '$id_to_confirm' AND mission_name = '$mission_to_confirm' ";
     $sql2 = " UPDATE  imgupload SET pass = 'pass' WHERE stu_id = '$id_to_confirm' AND mission_name = '$mission_to_confirm'";
    if (mysqli_query($conn, $sql) && mysqli_query($conn, $sql2)) {
        //success
        header('Location:upload.php');
     } else {
         //fail
         echo 'query error: ' . mysqli_error($conn);
     }
}

?>