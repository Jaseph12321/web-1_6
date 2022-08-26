<?php
   

if(isset($_POST["export"])){   
      $conn = mysqli_connect("localhost","root", "", "mission");
      //$conn = mysqli_connect("sql303.epizy.com","epiz_31622311", "Mr6cz40Y0Zwk1F", "epiz_31622311_mission");
      header("Content-Type: text/csv; charset=utf-8");
      header("Content-Disposition: attachment; filename= data.csv");
      $output = fopen("php://output", "w");
      fwrite($output,chr(0xEF).chr(0xBB).chr(0xBF));
      fputcsv($output, array('stu_ID', 'stu_name', 'mission_name','picture_name', 'image_url'));
      $q = "SELECT * FROM imgupload ";
      $result = mysqli_query($conn, $q);
      while($row = mysqli_fetch_assoc($result)){
         fputcsv($output, $row);
      }
      fclose($output);
}


?>