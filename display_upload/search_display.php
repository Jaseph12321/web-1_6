<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
            <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

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
        <h1 class="test text-center title ">成績查詢</h1>
        <br>
        <div class="table-responsive">
        <button type="button" class="btn btn-secondary test " style="width:30%; margin-bottom:2%;margin-left:70%" onclick="test()">積分查詢</button>
         </div>
        <table class="table table-bordered table-striped">

        <thead class="thead-light">
               <th>學號</th>
               <th>關卡</th>
               <th>照片</th>
               <th>通過</th>
               </thead>
            <tbody>
             
               <?php




if(isset($_POST['submit'])){
                           include('connect.php');
                           $student_id = $_POST['student_id'];

                           $displayquery = " select * from mission_confirm where mstu_id = '$student_id' and (pass = 'pass' or pass = 'not pass')";
                           $scorequery = " select t_score from the_score where sstu_id='$student_id'";
                           $querydisplay = mysqli_query($conn,$displayquery);
                           $scoredisplay = mysqli_query($conn,$scorequery);
                           $t_result = mysqli_fetch_array($scoredisplay);
                           $score = $t_result['t_score'];

                           //$row = mysqli_num_rows($querydisplay);

                           while($result = mysqli_fetch_array($querydisplay)){
                            $splitname = explode('/',$result['image']);
                            // image.jpg                           
                            $filename = $splitname[1];
                            $fileext = explode('.', $filename);
                            $filecheck = strtolower(end($fileext));
 
                            $flieextstored = array('png', 'jpg', 'jpeg');
                            $flieextstored_video = array('mp4','mov');
                                     ?>
                              <?php if(in_array($filecheck, $flieextstored)){ ?>
                                     <tr>
                                         <td><?php echo $result['mstu_id']; ?></td>
                                         <td><?php echo $result['mission_name']; ?></td>
                                         <td> <img src="<?php echo $result['image']; ?>" height="100px" weight="100px"></td>
                                         <td><?php echo $result['pass']; ?></td>
                                     </tr>
                                <?php } else if(in_array($filecheck, $flieextstored_video)) { ?>
                                    <tr>
                                         <td><?php echo $result['mstu_id']; ?></td>
                                         <td><?php echo $result['mission_name']; ?></td>
                                         <td> <video  height="200" weight="300" controls autoplay><source src="<?php echo $result['image']; ?>" type = "video/mp4"></video></td>
                                         <td><?php echo $result['pass']; ?></td>
                                     </tr>
                             <?php
                           } 
                          } 
                        }
            ?>

            </tbody>
            </table>
    </div>
    </div>
 </div>

 <script>
        function test() {
                var theScore = <?php echo $score ?>;
            swal({
                title: "目前積分 : "+ theScore,
                text: "若有問題請儘速反映",
                icon: "warning",
                button: {
                    text: "確認",
            
                },
            })
                
        };
    </script>
</body>
</html>