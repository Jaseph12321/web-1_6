<?php
    include('connect.php');

    $standard_a = "/^([SGsg]+)$/";
    $standard_b = "/^([0-9]{8}+)$/";
    
    $student_id = '';
    $errors = array('student_id'=>'');
    
    if(isset($_POST['submit'])){
        if(empty($_POST['student_id'])){
                        $errors['student_id'] ='An student id is required <br />';
                    }else{
                        $s1 = substr($_POST['student_id'],0,1);
                        $s2 = substr($_POST['student_id'],1,strlen($_POST['student_id'])-1);
                        if((!preg_match($standard_a,$s1)) || (!preg_match($standard_b,$s2))){
                            $errors['student_id'] ='The student id is invalid <br />';
                        }else{
                            header('Location: search_display.php');
                        }
                    }
         
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>成績查詢</title>
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
               <small>成績查詢</small>
               </h1>
               <div class="col-lg-8 m-auto d-block"></div>
               <form action="search_display.php" method="post" enctype="multipart/form-data" >
               <div class="form-group">
                       <labe for='user'>學號 (Student ID) :</label>
                       <input type="text" name="student_id" id="stu_id" class="form-control" >
                   </div>    
                   <input type="submit" name="submit" id="Submit" class="btn btn-success">
               </form>
          </div>
    </div>
    </body>
</html>