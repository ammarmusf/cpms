<?php //this script will update the database when a reviewer has submitted a review on a paper. 
	include("config.php");
	session_start();
	
	$paperid=mysqli_real_escape_string($db,  $_POST['h_pid']);
	$reviwerid=mysqli_real_escape_string($db,  $_POST['h_revid']);
	$complete="";

	$concomment=mysqli_real_escape_string($db,  $_POST['content_comments']);
	$wdcomment=mysqli_real_escape_string($db,  $_POST['wd_comments']);
	$opcomment=mysqli_real_escape_string($db,  $_POST['op_comments']);
	$orcomment=mysqli_real_escape_string($db,  $_POST['comments']);

	//------------------------------------------------------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------------------------------------------------------

	$option = isset($_POST['Appropriateness_of_Topic']) ? $_POST['Appropriateness_of_Topic'] : false; 
	if ($option) { 
			$Appropriateness_of_Topic=mysqli_real_escape_string($db,  $_POST['Appropriateness_of_Topic']);  
	}
	$option = isset($_POST['Timeliness_of_Topic']) ? $_POST['Timeliness_of_Topic'] : false; 
	if ($option) { 
			$Timeliness_of_Topic=mysqli_real_escape_string($db,  $_POST['Timeliness_of_Topic']);  
	}
	$option = isset($_POST['Supportive_Evidence']) ? $_POST['Supportive_Evidence'] : false; 
	if ($option) { 
			$Supportive_Evidence=mysqli_real_escape_string($db,  $_POST['Supportive_Evidence']);  
	}
	$option = isset($_POST['Technical_Quality']) ? $_POST['Technical_Quality'] : false; 
	if ($option) { 
			$Technical_Quality=mysqli_real_escape_string($db,  $_POST['Technical_Quality']);  
	}
	$option = isset($_POST['Scope_of_Coverage']) ? $_POST['Scope_of_Coverage'] : false; 
	if ($option) { 
			$Scope_of_Coverage=mysqli_real_escape_string($db,  $_POST['Scope_of_Coverage']);  
	}
	$option = isset($_POST['Citation_of_Previous_Work']) ? $_POST['Citation_of_Previous_Work'] : false; 
	if ($option) { 
			$Citation_of_Previous_Work=mysqli_real_escape_string($db,  $_POST['Citation_of_Previous_Work']);  
	}
	$option = isset($_POST['Originality']) ? $_POST['Originality'] : false; 
	if ($option) { 
			$Originality=mysqli_real_escape_string($db,  $_POST['Originality']);  
	}
	$option = isset($_POST['Organization_of_Paper']) ? $_POST['Organization_of_Paper'] : false; 
	if ($option) { 
			$Organization_of_Paper=mysqli_real_escape_string($db,  $_POST['Organization_of_Paper']);  
	}
	$option = isset($_POST['Clarity_of_Main_Message']) ? $_POST['Clarity_of_Main_Message'] : false; 
	if ($option) { 
			$Clarity_of_Main_Message=mysqli_real_escape_string($db,  $_POST['Clarity_of_Main_Message']);  
	}
	$option = isset($_POST['Mechanics']) ? $_POST['Mechanics'] : false; 
	if ($option) { 
			$Mechanics=mysqli_real_escape_string($db,  $_POST['Mechanics']);  
	}
	$option = isset($_POST['Suitability_for_Presentation']) ? $_POST['Suitability_for_Presentation'] : false; 
	if ($option) { 
			$Suitability_for_Presentation=mysqli_real_escape_string($db,  $_POST['Suitability_for_Presentation']);  
	}
	$option = isset($_POST['Potential_Interest_in_Topic']) ? $_POST['Potential_Interest_in_Topic'] : false; 
	if ($option) { 
			$Potential_Interest_in_Topic=mysqli_real_escape_string($db,  $_POST['Potential_Interest_in_Topic']);  
	}
	$option = isset($_POST['Overall_Rating']) ? $_POST['Overall_Rating'] : false;
	if ($option) {
			$orrating=mysqli_real_escape_string($db,  $_POST['Overall_Rating']);  
	}  

	//------------------------------------------------------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------------------------------------------------------
	
	$sum1 = (0.5*($Appropriateness_of_Topic + $Timeliness_of_Topic + $Supportive_Evidence + $Technical_Quality + $Scope_of_Coverage + $Citation_of_Previous_Work + $Originality + $Organization_of_Paper + $Clarity_of_Main_Message + $Mechanics + $Suitability_for_Presentation + $Potential_Interest_in_Topic))/12;
	$sum2 = $orrating * 0.5;
	$orrating_final = $sum1 + $sum2;

	if(isset($_POST['b_save'] )){
	$complete="N";
		$complete=mysqli_real_escape_string($db,  $complete);
	}
	if(isset($_POST['b_submit'] )){
		$complete="Y";
		$complete=mysqli_real_escape_string($db,  $complete);
	$sql_update="update Paper set status='Y' where paperid='$paperid'";
	mysqli_query($db,$sql_update);
	}

	$sql_delete="delete from review where paperId='$paperid'";
	mysqli_query($db,$sql_delete);

	$sql_insert="insert into review (paperId,reviewerid,complete,overallRating,or_comments,content_comments,Appropriateness_of_Topic,
	Timeliness_of_Topic,
	Supportive_Evidence,
	Technical_Quality,
	Scope_of_Coverage,
	Citation_of_Previous_Work,
	Originality,
	Organization_of_Paper,
	Clarity_of_Main_Message,
	Mechanics,
	Suitability_for_Presentation,
	Potential_Interest_in_Topic,
	wdcomment,
	opcomment) values ('$paperid','$reviwerid','$complete','$orrating_final','$orcomment','$concomment','$Appropriateness_of_Topic',
	'$Timeliness_of_Topic',
	'$Supportive_Evidence',
	'$Technical_Quality',
	'$Scope_of_Coverage',
	'$Citation_of_Previous_Work',
	'$Originality',
	'$Organization_of_Paper',
	'$Clarity_of_Main_Message',
	'$Mechanics',
	'$Suitability_for_Presentation',
	'$Potential_Interest_in_Topic',
	'$wdcomment',
	'$opcomment')";
	mysqli_query($db,$sql_insert);

	if(isset($_POST['b_save'] )){
	go_back();  
	}
	if(isset($_POST['b_submit'] )){
	header("location:Homepage.php");
	}
?>