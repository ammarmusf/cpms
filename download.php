<?php
	//this script is an action to download a file from the database.
	include('config.php');
	session_start();
	
		if(!empty($_GET['file'])){
		
			//file called upload
			$type="upload";
		
			if(!empty($_GET['type'])){
		
			if(strcasecmp($_GET['type'],"report")==0){
				//file called reports
				$type="reports";    
			}
		}
		
		//according to the if statement above, it will go to the directory of the file in the variable filepath.
		$filename=basename($_GET['file']);
		$filepath=$type.'/'.$filename;
		
		//check if the file exsists in the database and then downloads the file.
		if(!empty($filename) && file_exists($filepath) ){
		
			header("Cache-Control: public");
			header("Content-Description: FIle Transfer");
			header("Content-Disposition: attachment; filename=$filename");
			header("Content-Type: application/zip");
			header("Content-Transfer-Emcoding: binary");
			
			readfile($filepath);
			exit;
		}
	}

?>