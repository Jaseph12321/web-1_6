<?php
  

  include('connect.php');
  if(isset($_POST['input_score'])){
      $t_score = $_POST['student_score'];
       $t_id = $_POST['student_id'];
      $sql = "UPDATE the_score SET t_score = '$t_score' where sstu_id = '$t_id' ";
      if(mysqli_query($conn,$sql)){
          echo 'upload success';
          sleep(5);
          header('Location: total_score.php');
      }else{
          echo 'upload failure';
          sleep(5);
          header('Location: total_score.php');
      }
  }

?>
