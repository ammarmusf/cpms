<?php
//this action file will control when an admin will delete the papers from the cpms database.
   include('config.php');
   session_start();
   
    if($_SERVER["REQUEST_METHOD"] == "POST") {
    
      $option = isset($_POST['s_action']) ? $_POST['s_action'] : false;
   if ($option) {
     	$action = mysqli_real_escape_string($db,$_POST['s_action']);   
   }
       
        $ppid= mysqli_real_escape_string($db,$_POST['h_ppid']);
        
    if(strcasecmp($action,"delete") == 0) {
   
        $sql="delete from Paper where paperid='$ppid'";
        $sql2="delete from review where paperId='$ppid'";
        
        mysqli_query($db,$sql);
        mysqli_query($db,$sql2);
        
    }else{
        
        $sql="update  Paper set status='N' where paperid='$ppid'";
        $sql2="delete from review where paperId='$ppid'";
        
        mysqli_query($db,$sql);
        mysqli_query($db,$sql2);
        
    }
   
       header("location: generate_report.php");
    }

?>