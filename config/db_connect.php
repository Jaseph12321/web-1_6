<?php
  $conn = mysqli_connect('localhost','root','',null);
  //check connection status
  if(!$conn){
      echo 'connection failed'. mysqli_connect_error();
  }