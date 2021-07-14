<?php
   include("config.php");
   session_start();
   
   
	
    if($_SERVER["REQUEST_METHOD"] == "POST") {
	
		//we are retrieving the information from the form entered by the user for sign-up.
		$tUsername	 = mysqli_real_escape_string($db,$_POST['tUsername']); 			
		$tPassword    = mysqli_real_escape_string($db,$_POST['tPassword']);           
		$tFirstName   = mysqli_real_escape_string($db,$_POST['tFirstName']);          
		$tMiddleInitials = mysqli_real_escape_string($db,$_POST['tMiddleInitials']);     
		$tLastName    = mysqli_real_escape_string($db,$_POST['tLastName']);           
		$tAffiliation = mysqli_real_escape_string($db,$_POST['tAffiliation']);        
		$tUniversity  = mysqli_real_escape_string($db,$_POST['tUniversity']);         
		$tDepartment  = mysqli_real_escape_string($db,$_POST['tDepartment']);         
		$tAddress     = mysqli_real_escape_string($db,$_POST['tAddress']);            
		$tCity        = mysqli_real_escape_string($db,$_POST['tCity']);               
		$tState       = mysqli_real_escape_string($db,$_POST['tState']);              
		$tZipCode     = mysqli_real_escape_string($db,$_POST['tZipCode']);            
		$tPhoneNumber = mysqli_real_escape_string($db,$_POST['tPhoneNumber']);        
		$tEmailAddress = mysqli_real_escape_string($db,$_POST['tEmailAddress']);       
	    
		//checking if the user is a reviewer. if its reviewer, we are going to insert the above information + interest1,2,3 into reviewer database table.
		//moreover, it will insert it into the users table which holds simple registered user information.
		//else, it will insert the data above only into the authors/users table.
	    if (isset($_POST['isreviewer']) && $_POST['isreviewer'] == 'isreviewer') {
	
			$option = isset($_POST['interest1']) ? $_POST['interest1'] : false;
			if ($option) {
					$interest1 = mysqli_real_escape_string($db,$_POST['interest1']);   
			}

			$option = isset($_POST['interest2']) ? $_POST['interest2'] : false;
			if ($option) {
				$interest2 = mysqli_real_escape_string($db,$_POST['interest2']);   
			}
			
			$option = isset($_POST['interest3']) ? $_POST['interest3'] : false;
			if ($option) {
				$interest3 = mysqli_real_escape_string($db,$_POST['interest3']);   
			}
				

			$sql="insert into users (username,password,role) values ('$tUsername','$tPassword','reviewer')";
			$sql2="insert into reviewer (username,first_name,middle_name,last_name, Affiliation, University, Department, Address, City, State, Zip_Code, Phone_Number, Email_Address,	interest_1,	interest_2,	interest_3 ) values ( '$tUsername','$tFirstName', '$tMiddleInitials', '$tLastName', '$tAffiliation', '$tUniversity', '$tDepartment', '$tAddress', '$tCity', '$tState', '$tZipCode', '$tPhoneNumber', '$tEmailAddress', '$interest1', '$interest2', '$interest3')";
		}else{
			$sql="insert into users (username,password,role) values ('$tUsername','$tPassword','author')";
			$sql2="insert into author (username,first_name,middle_name,last_name, Affiliation, University, Department, Address, City, State, Zip_Code, Phone_Number, Email_Address ) values ( '$tUsername','$tFirstName', '$tMiddleInitials', '$tLastName', '$tAffiliation', '$tUniversity', '$tDepartment', '$tAddress', '$tCity', '$tState', '$tZipCode', '$tPhoneNumber', '$tEmailAddress' )";			
		}

	//executing the queries.
	$rs1=mysqli_query($db,$sql);	
	$rs2=mysqli_query($db,$sql2);

	//error message when username/email/phone_no already exists when signing up.
	if($rs1 >=1 && $rs2 >=1){
		$_SESSION['login_error_msg']="";
		header("location: index.php");   
	}else{
		$_SESSION['login_error_msg']="username/email/phone number already in use.. Please select different one";
		header("location: index.php");   
	}
 
}
  
  
?>