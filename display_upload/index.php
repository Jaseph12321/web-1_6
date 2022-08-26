<?php

                 include('connect.php');
                   
                 $standard_a = "/^([SGsg]+)$/";
                 $standard_b = "/^([0-9]{8}+)$/";
                 $standard_c = "/^([0-9]+)$/";

                 $student_id = $student_name = $mission_name = $username = $files=''; 

                 $errors = array('student_id'=>'','student_name'=>'','mission_name'=>'', 'username'=>'', 'file'=>'');

                 if(isset($_POST['submit'])){

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

                    if(empty($_POST['student_name'])){
                        $errors['student_name'] ='An student name is required <br />';
                    }else{
                        if(preg_match($standard_c,$_POST['student_name'])){
                            $errors['student_name'] ='The student name is invalid , it should be no numbers <br />';
                        }else{
                            $student_name = $_POST['student_name'];
                        }
                        
                    }

                    if(empty($_POST['mission_name'])){
                        $errors['mission_name'] ='An mission name is required <br />';
                    }else{
                        $mission_name = $_POST['mission_name'];
                    }

                    if(empty($_POST['username'])){
                        $errors['username'] ='An photo name is required <br />';
                    }else{
                        $username = $_POST['username'];
                    }

                    if(empty($_FILES['file'])){
                        $errors['username'] ='An file is required <br />';
                    }else{
                        $files = $_FILES['file'];
                    }
                     
                    

                       print_r($username);
                       echo "<br>";
                       //print_r($files);
                       if(array_filter($errors)){
                        //echo 'errors in the form';
                        }else{

                       $filename = $files['name'];
                       $fileerror = $files['error'];
                       $filetmp = $files['tmp_name'];

                       $fileext = explode('.', $filename);
                       $filecheck = strtolower(end($fileext));

                       $flieextstored = array('png', 'jpg', 'jpeg','mp3', 'mov');

                       if(in_array($filecheck,$flieextstored)){
                           $destinationfile = 'upload/'.$filename;
                           move_uploaded_file($filetmp,$destinationfile);

                           $q = "INSERT INTO `imgupload`(`stu_id`, `student_name`,`mission_name`,`photo_name`,`pass`, `image`) VALUES ('$student_id','$student_name','$mission_name','$username','null', '$destinationfile')";
                           $q2 = "INSERT INTO `mission_confirm`(`mstu_id`,`mission_name`,`image`,`pass`) VALUES ('$student_id','$mission_name','$destinationfile','pass')";
                           $q3 = "SELECT sstu_id FROM the_score WHERE sstu_id = '$student_id'";
                           $q4 = "INSERT INTO `the_score`(`sstu_id`, `t_score`) value('$student_id','0')";
                           $result = mysqli_query($conn,$q3);
                           if(mysqli_query($conn, $q) && mysqli_query($conn,$q2)){
                            //success
                            if(mysqli_num_rows($result)==0){
                                   mysqli_query($conn, $q4);
                            }
                            header('Location: ../index.html');
                        }else{
                            echo "Error: " . mysqli_error($conn);
                        }
                       } 
                       }
                       
                       }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>上傳紀錄</title>
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
    <body onload="get()">
    <div style="padding:100px 1.5%; height: 100vh; background-image: url(../upload.png); background-repeat: no-repeat; background-attachment: fixed; background-size: 100% 100%;">
        <div class="container" style=" border-radius: 10px; width:100%; background: rgba(255, 255, 255, .5); backdrop-filter: blur(10px) ">
            <h1 class="text-center title test ">
                <small>任務回報</small>
            </h1>
            <div class="col-lg-8 m-auto d-block"></div>
            <form action="index.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for='user'>學號 (Student ID) :</label>
                    <input type="text" name="student_id" id="stu_id" class="form-control" value="<?php echo htmlspecialchars($student_id); ?>">
                    <div class="text-danger"><?php echo $errors['student_id']; ?></div>
                </div>
                <div class="form-group">
                    <label for='user'>學生姓名 (Student name):</label>
                    <input type="text" name="student_name" id="stu_name" class="form-control" value="<?php echo htmlspecialchars($student_id); ?>">
                    <div class="text-danger"><?php echo $errors['student_name']; ?></div>
                </div>

                <div class="form-group">
                    <label for='user'>任務名 (Mission name):</label>
                    <input type="text" readonly="readonly" name="mission_name" id="mission_name" class="form-control" >
                    <div class="text-danger"><?php echo $errors['mission_name']; ?></div>
                </div>


                <div class="form-group">
                    <label for='user'>文字回報 (Text):</label>
                    <input type="text" name="username" id="user" class="form-control" value="<?php echo htmlspecialchars($username); ?>">
                    <div class="text-danger"><?php echo $errors['username']; ?></div>


                </div>
                <div class="form-group">
                    <label for="file">Pictures</label>
                    <input type="file" name="file" id="file" class="form-control">
                </div>
                <input type="submit" name="submit" id="Submit" class="btn btn-success">
            </form>
        </div>
    </div>



    <script src="../test.js"></script>
</body>
</html>