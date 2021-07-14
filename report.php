<?php //this script will generate the reports of a paper that has been reviewed.
    include("config.php");
    session_start();
  
    if($_SERVER["REQUEST_METHOD"] == "POST") {

        $ppId = mysqli_real_escape_string($db,$_POST['h_ppid']);   
        $sql_Paper="select * from review where paperId='$ppId'";
        $result = mysqli_query($db,$sql_Paper);
        $count = mysqli_num_rows($result);
        
        if($count >= 1){

            $delimiter = ",";
            $filename="Review_report.csv";
            $filepath = 'reports/'.$filename;
            
            $f = fopen($filepath, 'w');
            
            //set column headers
            $fields = array('paperId', 'overallRating', 'Appropriateness_of_Topic', 'Timeliness_of_Topic', 'Supportive_Evidence', 'Technical_Quality', 'Scope_of_Coverage', 'Citation_of_Previous_Work', 'Originality', 'Organization_of_Paper', 'Clarity_of_Main_Message', 'Mechanics', 'Suitability_for_Presentation', 'Potential_Interest_in_Topic', 'or_comments', 'content_comments', 'wdcomment', 'opcomment');
            fputcsv($f, $fields, $delimiter);
            
            //output each row of the data, format line as csv and write to file pointer
            while($row = mysqli_fetch_assoc($result)){
                $lineData = array($row['paperId'], $row['overallRating'], $row['Appropriateness_of_Topic'], $row['Timeliness_of_Topic'], $row['Supportive_Evidence'], $row['Technical_Quality'], $row['Scope_of_Coverage'], $row['Citation_of_Previous_Work'], $row['Originality'], $row['Organization_of_Paper'], $row['Clarity_of_Main_Message'], $row['Mechanics'], $row['Suitability_for_Presentation'], $row['Potential_Interest_in_Topic'], $row['or_comments'], $row['content_comments'], $row['wdcomment'], $row['opcomment']);
                fputcsv($f, $lineData, $delimiter);
            }
            
            fclose($f);
            header('location: download.php?file='.$filename.'&type=report'); 
        }
    }            
?>