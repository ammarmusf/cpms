<?php //tester
   include("config.php");
   session_start();
   
   $sql = "SELECT role FROM users";
   $result = mysqli_query($db,$sql);
   $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

   $count = mysqli_num_rows($result);
   
   if($count >= 1) {
      header("location: index.php");
   }
?>