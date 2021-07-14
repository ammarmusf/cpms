<?php //action script that will logout the user.
   session_start();
   
   if(session_destroy()) {
      header("Location: index.php");
   }
?>