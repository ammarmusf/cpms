<?php
   //configuration file to connect to the databse
   define('DB_SERVER', 'localhost'); //set this to your localhost or server -----> define('DB_SERVER', 'edit here');
   define('DB_USERNAME', 'root'); //set this to your db username
   define('DB_PASSWORD', ''); //set this to your db password
   define('DB_DATABASE', 'cpms'); //set this to your database name
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
   
   $_SESSION['login_error_msg']="";
   
   //takes the user back to the previous page.
   function go_back(){
	header("location:javascript://history.go(-1)");
	exit;
}
?>