<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>上傳紀錄</title>
            <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<style>
        @import url("https://fonts.googleapis.com/css?family=Noto+Serif+TC&amp;display=swap");

         .test {
             font-family: 'Gill Sans', 'sans-serif','cwTeXFangSong ',sans-serif !important;
             font-weight: 500;

         }
       .title{
             background: linear-gradient(to bottom, #52E5E7 15%, #130CB7 100%);
             background: -webkit-linear-gradient( to bottom,#52E5E7 15%, #130CB7 100%);
             background-clip: text;
             -webkit-background-clip: text;
             color: transparent;
        
        }
        </style>
</head>
<body>
<div style="padding:10% 3%; min-height:100vh;   display: flex; background: linear-gradient(15deg,#794095,#0d1430); background-size:cover">
        <div class="container " style=" height:fit-content; border-radius: 10px; width:100%; background: rgba(255, 255, 255, .5); backdrop-filter: blur(10px) ">
        <h1 class="test text-center title ">上傳紀錄</h1>
        <br>
        <div class="table-responsive">
        <form method="post" action="">
                <div class="row">
                    <div class="col-md-9">
                        <input type="text" name="input" class="form-control" placeholder=" 請輸入學號或關卡名稱">
                    </div>
                    <div class="col-md-3">
                        <input type="submit" name="search" class="btn btn-info" value="Search">
                    </div>
                </div>
            </form>
        <br>
        <table class="table table-bordered table-striped">

        <thead class="thead-light">
               <th>學號</th>
               <th>姓名</th>
               <th>關卡</th>
               <th>照片名稱</th>
               <th>通過</th>
               <th>照片/影片</th>
               <th>確認</th>
               <th>刪除</th>
               </thead>
            <tbody>
             
               <?php
                        // haven't search
                          include('connect.php');
                          if(isset($_POST['search'])){
                              $person = $_POST['input'];
                              $displayquery = " select * from imgupload where stu_id = '$person' or mission_name ='$person' ";
                          }else{
                           $displayquery = " select * from imgupload ";
                          }
                           $querydisplay = mysqli_query($conn,$displayquery);
                           
                           //$row = mysqli_num_rows($querydisplay);

                           while($result = mysqli_fetch_array($querydisplay)){
                            // ex: upload/image.jpg
                            $splitname = explode('/',$result['image']);
                            // image.jpg                           
                            $filename = $splitname[1];
                            $fileext = explode('.', $filename);
                            $filecheck = strtolower(end($fileext));
 
                            $flieextstored = array('png', 'jpg', 'jpeg');
                            $flieextstored_video = array('mp3','mov');
                                     ?>
                            <?php if(in_array($filecheck, $flieextstored)){ ?>
                                     <tr>
                                         <!-- output and display-->
                                         <td><?php echo $result['stu_id']; ?></td>
                                         <td><?php echo $result['student_name']; ?></td>
                                         <td><?php echo $result['mission_name']; ?></td>
                                         <td><?php echo $result['photo_name']; ?></td>
                                         <td><?php echo $result['pass']; ?></td>
                                         <td> <img src="<?php echo $result['image']; ?>" height="125px" weight="125px"></td>
                                         <td>
                                <!-- delete function where the file is in the folder functions/delete.php-->                 
                            <form action="confirm.php" method="POST">
                            <input type="hidden" name="mission_to_confirm" value="<?php echo $result['mission_name']; ?>">
                            <input type="hidden" name="id_to_confirm" value="<?php echo $result['stu_id']; ?>">
                            <button class="btn btn-success btn-sm rounded-0" type="submit" name="confirm" data-toggle="tooltip" data-placement="top" title="confirm"><i class="fa fa-trash">confirm</i></button>
                            </form>
                        </td>
                         <td>
                                <!-- delete function where the file is in the folder functions/delete.php-->                 
                            <form action="delete.php" method="POST">
                            <input type="hidden" name="mission_to_confirm" value="<?php echo $result['mission_name']; ?>">
                            <input type="hidden" name="id_to_delete" value="<?php echo $result['stu_id']; ?>">
                            <button class="btn btn-danger btn-sm rounded-0" type="submit" name="delete" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash">delete</i></button>
                            </form>
                        </td>
                </tr>
                <?php }else if(in_array($filecheck, $flieextstored_video)) { ?>

                    <tr>
                                         <!-- output and display-->
                                         <td><?php echo $result['stu_id']; ?></td>
                                         <td><?php echo $result['student_name']; ?></td>
                                         <td><?php echo $result['mission_name']; ?></td>
                                         <td><?php echo $result['photo_name']; ?></td>
                                         <td><?php echo $result['pass']; ?></td>
                                         <td><video  height="200" weight="300" controls autoplay><source src="<?php echo $result['image']; ?>" type = "video/mp4"></video></td>
                                         <td>
                                <!-- delete function where the file is in the folder functions/delete.php-->                 
                            <form action="confirm.php" method="POST">
                            <input type="hidden" name="mission_to_confirm" value="<?php echo $result['mission_name']; ?>">
                            <input type="hidden" name="id_to_confirm" value="<?php echo $result['stu_id']; ?>">
                            <button class="btn btn-success btn-sm rounded-0" type="submit" name="confirm" data-toggle="tooltip" data-placement="top" title="confirm"><i class="fa fa-trash">confirm</i></button>
                            </form>
                        </td>
                                         <td>
                                <!-- delete function where the file is in the folder functions/delete.php-->                 
                            <form action="delete.php" method="POST">
                            <input type="hidden" name="mission_to_confirm" value="<?php echo $result['mission_name']; ?>">
                            <input type="hidden" name="id_to_delete" value="<?php echo $result['stu_id']; ?>">
                            <button class="btn btn-danger btn-sm rounded-0" type="submit" name="delete" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash">delete</i></button>
                            </form>
                        </td>
                </tr>


                    <?php } ?>

         <?php
                }     
            ?>

            </tbody>
            </table>
            <br>
            <!-- export the sql data to csv file where  the file is in the folder functions/toexcel.php -->
            <form method="post" action="toexcel.php">
            <input type="submit" name="export" class="btn btn-success" value="CSV Export" />
    </form>
    </div>
    </div>
 </div>
</body>
</html>