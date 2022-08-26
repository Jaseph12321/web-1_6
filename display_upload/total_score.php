<?php
  

  include('connect.php');

  $standard_a = "/^([SGsg]+)$/";
  $standard_b = "/^([0-9]{8}+)$/";
  $standard_c = "/^([0-9]+)$/";

  $student_id = $student_score = ''; 

  $errors = array('student_id'=>'','student_score'=>'');
  if(isset($_POST['input_score'])){

                    if(empty($_POST['student_id'])){
                        $errors['student_id'] ='An student id is required <br />';
                    }else{
                        $s1 = substr($_POST['student_id'],0,1);
                        $s2 = substr($_POST['student_id'],1,strlen($_POST['student_id'])-1);
                        if((!preg_match($standard_a,$s1)) || (!preg_match($standard_b,$s2))){
                            $errors['student_id'] ='The student id is invalid <br />';
                        }else{
                            $student_id = $_POST['student_id'];
                        }
                    }

                    if(empty($_POST['student_score'])){
                        $errors['student_score'] ='A score is required <br />';
                    }else{
                        if((!preg_match($standard_c,$_POST['student_score']))){
                            $errors['student_score'] ='The score is invalid, only numbers <br />';
                        }else{
                            $student_score = $_POST['student_score'];
                        }
                    }

      $sql = "UPDATE the_score SET t_score = '$student_score' where sstu_id = '$student_id' ";
      $q3 = "SELECT sstu_id FROM the_score WHERE sstu_id = '$student_id'";


      $result = mysqli_query($conn,$q3);

      if(mysqli_num_rows($result)>0){
          if(mysqli_query($conn,$sql)){
          echo 'upload success';
          sleep(5);
          header('Location: total_score.php');
      }else{
          echo "Error: " . mysqli_error($conn);
          
      }
                                   
      }else{
          $errors['student_id'] ='The student id does not exist  <br />';
          echo "Error: " . mysqli_error($conn);
      }
  }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <style>
        @import url("https://fonts.googleapis.com/css?family=Noto+Serif+TC&amp;display=swap");

        .test {
            font-family: 'Gill Sans', 'sans-serif','cwTeXFangSong ',sans-serif !important;
            font-weight: 500;
        }

        .title {
            background: linear-gradient(to bottom, #52E5E7 15%, #130CB7 100%);
            background: -webkit-linear-gradient( to bottom,#52E5E7 15%, #130CB7 100%);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
        }
    </style>
    </head>
    <body>
    <div style="padding:170px 1.5%; height: 100vh; background-image: url(../upload.png); background-repeat: no-repeat; background-attachment: fixed; background-size: 100% 100%;">
        <div class="container" style=" border-radius: 10px; width:100%; background: rgba(255, 255, 255, .5); backdrop-filter: blur(10px) ">
               <h1 class="text-center title test ">
               <small>總積分輸入</small>
               </h1>
               <div class="col-lg-8 m-auto d-block"></div>
               <form action="total_score.php" method="post" enctype="multipart/form-data" >
               <div class="form-group">
                       <labe for='user'>學號 (Student ID) :</label>
                       <input type="text" name="student_id" id="stu_id" class="form-control" value="<?php echo htmlspecialchars($student_id); ?>" >
                       <div class="text-danger"><?php echo $errors['student_id']; ?></div>
                   </div>    
                   <div class="form-group">
                       <labe for='user'>總積分 :</label>
                       <input type="text" name="student_score" id="stu_score" class="form-control" value="<?php echo htmlspecialchars($student_score); ?>">
                       <div class="text-danger"><?php echo $errors['student_score']; ?></div>
                   </div> 
                   <input type="submit" name="input_score" id="Submit" class="btn btn-success">
               </form>
          </div>
    </div>
    </body>
</html>