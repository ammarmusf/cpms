<?php
include("config.php");
   session_start();
 $uname=mysqli_real_escape_string($db,$_SESSION['user_name']);
 
if(isset($_POST['intial_upload'] )){
    $file_name=$_FILES['uploaded_report']['name'];
    $file_temp_loc=$_FILES['uploaded_report']['tmp_name'];
    $file_store="upload/".$file_name;
    move_uploaded_file($file_temp_loc,$file_store);
    
    
    $title=mysqli_real_escape_string($db,$_POST['p_title']);
     
     $option = isset($_POST['topic']) ? $_POST['topic'] : false;
   if ($option) {
     	$topic = mysqli_real_escape_string($db,$_POST['topic']);   
   }
    
    $file_name_sql=mysqli_real_escape_string($db,$file_name); 
    $topic_sql=mysqli_real_escape_string($db,$topic); 
    
    $sql_author="select author_id from author where username='$uname'";
    
     $result = mysqli_query($db,$sql_author);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $authorid=mysqli_real_escape_string($db,$row['author_id']);
   $comments= mysqli_real_escape_string($db,$_POST['comment']);
     $sql="insert into Paper (authorid,filename,Comments,topic,title) values ('$authorid','$file_name_sql','$comments','$topic_sql','$title')";
    $result2 = mysqli_query($db,$sql);
    
     header("location: paper_submission_form.php");
    
    
}






?>