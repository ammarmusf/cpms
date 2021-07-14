<?php //this script will allow the user to edit their profile information and update them in the database simultaniously.
include("config.php");
	session_start();
	
		if($_SERVER["REQUEST_METHOD"] == "POST") {

			$t_first_name = mysqli_real_escape_string($db,$_POST['t_first_name']);
			$t_middle_initial = mysqli_real_escape_string($db,$_POST['t_middle_initial']);
			$t_last_name = mysqli_real_escape_string($db,$_POST['t_last_name']);
			$t_Affiliation = mysqli_real_escape_string($db,$_POST['t_Affiliation']);
			$t_University = mysqli_real_escape_string($db,$_POST['t_University']);
			$t_Department = mysqli_real_escape_string($db,$_POST['t_Department']);
			$t_Address = mysqli_real_escape_string($db,$_POST['t_Address']);
			$t_City = mysqli_real_escape_string($db,$_POST['t_City']);
			$t_State = mysqli_real_escape_string($db,$_POST['t_State']);
			$t_Zip = mysqli_real_escape_string($db,$_POST['t_Zip']);
			$t_Phone_Number = mysqli_real_escape_string($db,$_POST['t_Phone_Number']);
			$t_Email = mysqli_real_escape_string($db,$_POST['t_Email']);
			$role=mysqli_real_escape_string($db,$_SESSION['role']) ;
			$uname=mysqli_real_escape_string($db,$_SESSION['user_name']);
		
			$sql="update ".$role." set 
			first_name        ='$t_first_name',
			middle_name    ='$t_middle_initial',
			last_name         ='$t_last_name',
			Affiliation       ='$t_Affiliation',
			University        ='$t_University',
			Department        ='$t_Department',
			Address           ='$t_Address',
			City              ='$t_City',
			State             ='$t_State',
			Zip_Code               ='$t_Zip',
			Phone_Number      ='$t_Phone_Number',
			Email_Address         ='$t_Email'
			where username='$uname'";
		
			mysqli_query($db,$sql);
	  	}
	header("location: Profile.php");
   
?>