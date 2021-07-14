<?php
include("config.php");
   session_start();

if(isset($_POST['upload'] )){
    $file_name=$_FILES['file']['name'];
    $file_temp_loc=$_FILES['file']['tmp_name'];
    $file_store="upload/".$file_name;
   
    
    $file_name_sql=mysqli_real_escape_string($db,$file_name);
	
	$h_title_sql=mysqli_real_escape_string($db,$_POST['h_title']);
	$h_topic_sql=mysqli_real_escape_string($db,$_POST['h_topic']);
	$h_filename_sql=mysqli_real_escape_string($db,$_POST['h_filename']);
	$h_authorid_sql=mysqli_real_escape_string($db,$_POST['h_authorid']);
	
	$sql_replace="update Paper set filename='$file_name_sql' where filename='$h_filename_sql' and authorid='$h_authorid_sql' and topic='$h_topic_sql' and title='$h_title_sql'";

	mysqli_query($db,$sql_replace);
	
	 move_uploaded_file($file_temp_loc,$file_store);
    
}

?>


<div class="container">    
  <head>
    <!-- Below is styling -->
  <style>
    body {
    background-color: #fff;
    font-family: Lato, sans-serif;
    }
    .container {
    background: linear-gradient(90deg, rgba(1,1,1,1) 5%, rgba(199,147,241,1) 81%, rgba(180,124,195,1) 100%);
    }
    header {
    padding: 20px 40px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #bfc4ff;
    box-sizing: border-box;
    position: fixed;
    width: 100%;
    top: 0;
    left: 0;

    font-family: Poppins, sans-serif;
    color: #222;
    }
    h1 {
    font-size: 2rem;
    }
    underline {
    text-decoration: underline;
    }
    li {
    display: inline-block;
    margin: 0 10px;
    font-size: 1rem;
    font-weight: 700;
    text-transform: uppercase;
    }
    main {
    min-height: 1200px;
    max-width: 90vw;  
    margin: 120px auto;
    padding-top: 40px;
    }
    p {
    font-size: 1.2rem;
    line-height: 1.5;
    color: #fbfbfb;
    }
    p2 {
    font-size: 1.2rem;
    line-height: 1.5;
    color: yellow;
    }
    login {
    font-size: 2rem;
    line-height: 1.5;
    color: #fbfbfb;
    }
    form {
    font-size: 1.2rem;
    line-height: 1.5;
    color: #fbfbfb;
    }
    form2{
      color: blue;
    }
    .button { 
    height: 25px; 
    width: 75px; 
    } 
    forgotpass {
    color: #0645AD
    }
    table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
    }
    td, th {
    color: #dddddd;
    font-weight: bold;
    border: 1px solid #dddddd;
    text-align: center;
    padding: 8px;
    }
    th{
    font-size: 20px;
    background-color: #222;
    }
    tr:nth-child(even) {
    background-color: #808080;
    }
    footer {
    left: 0;
    bottom: 0;
    height: 50px;
    width: 100%;
    background-color: #bfc4ff;
    color: #000000;
    text-align: center;
    }

    </style>
  </head>

  <header>
    <h1>CCSC - Consortium for Computing Sciences</h1>
    <nav>
      <ul>
        <li><a href="Homepage.php">Home</a></li>

        <?php //displays the toolbar according to the role of the user logged in.  
          $role=$_SESSION['role'] ;
          if(strcasecmp($role,"author") == 0) {       
              echo "<li><a href=paper_submission_form.php>Submit Paper</a></li>";
          }
          
          if(strcasecmp($role,"admin") == 0) {       
              echo "<li><a href=generate_report.php> Manage Submission </a></li>";
          }  
        ?>

        <li><a href="Profile.php">Profile</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <p style="text-align:center">
      CCSC Paper Submission      <br><p2>Submit papers into the CPMS below</p2>
    </p>
    <br><br>
    
<?php 
  //we are retrieving the papers information that is linked with the author.
  $uname=mysqli_real_escape_string($db,$_SESSION['user_name']);
  $sql_author="select author_id from author where username='$uname'";
  $result = mysqli_query($db,$sql_author);
  $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
  $authorid=mysqli_real_escape_string($db,$row['author_id']);
  $sql_paper="select * from Paper where authorid='$authorid'";
  $result2 = mysqli_query($db,$sql_paper);
  $count = mysqli_num_rows($result2);
  
  //if one or more papers have been found in the db, we are going to display all the papers information onto a table.
  if($count >= 1) {
    echo "<table> 	<tr>     <th>Paper Title</th>     <th>Submission Date</th>     <th>Topic</th>     <th>Current Submission</th> <th>Overall Rating</th>     <th>Upload Paper</th>     <th>Re-Submit</th>   </tr>";
    while($row2 = mysqli_fetch_assoc($result2)) {  

      $pp_id=mysqli_real_escape_string($db,$row2['paperid']);
      $sql_rating="select * from review  where paperId='$pp_id'";
      $rating_result = 	mysqli_query($db,$sql_rating);
      $rating_row = mysqli_fetch_array($rating_result,MYSQLI_ASSOC);
      $rating_value=mysqli_real_escape_string($db,$rating_row['overallRating']);
      $count_rating = mysqli_num_rows($rating_result);
      $title=mysqli_real_escape_string($db,$row2['title']);
      $date=mysqli_real_escape_string($db,$row2['date']);
      $topic=mysqli_real_escape_string($db,$row2['topic']);
      $filename=mysqli_real_escape_string($db,$row2['filename']);
    
      echo '<tr><td>'.$title.'</td>';
      echo '<td>'.$date.'</td>';
      echo '<td>'.$topic.'</td>';
      echo '<td>'.$filename.'</td>';

      if($count_rating > 0){
        echo '<td>'.number_format($rating_value,1).'</td>';
      }else{
        echo '<td>Not Reviewed</td>'; 
      }
      
      echo '<td><form action="" method=POST enctype=multipart/form-data>';
      echo '<input type="hidden" name="h_title" value="'.$title.'"> ';
      echo '<input type="hidden" name="h_topic" value="'.$topic.'"> ';
      echo '<input type="hidden" name="h_filename" value="'.$filename.'"> ';
      echo '<input type="hidden" name="h_authorid" value='.$authorid.'> ';
      echo '<input type="file"  name="file" required></td><td><input type="submit" name ="upload" value="Re-Submit" />    </td>	</form>';
    }
    echo '</table>';
  }
?>
    
    <br><br><br><br>
    
    <p>Submit a new paper:</p>
    
  <table>
    <tr>
      <th>Paper Title</th>
      <th>Topic</th>
      <th>Comment</th>
      <th>Upload Paper</th>
      <th>Submit</th>
    </tr>
    <tr><form action="action_page.php" method= "POST" enctype="multipart/form-data">
      <td><input type="text"  name="p_title" required></td>
      <td><select name="topic"> 
            <option value="Analysis of Algorithms">Analysis of Algorithms</option>
            <option value="Applications">Applications</option>
            <option value="Architecture">Architecture</option>
            <option value="Artificial Intelligence">Artificial Intelligence</option>
            <option value="Computer Engineering">Computer Engineering</option>
            <option value="Curriculum">Curriculum</option>
            <option value="Data Structures">Data Structures</option>
            <option value="Databases">Databases</option>
            <option value="Distance Learning">Distance Learning</option>
            <option value="Distributed Systems">Distributed Systems</option>
            <option value="EthicalSocietalIssues">EthicalSocietalIssues</option>
            <option value="FirstYearComputing">FirstYearComputing</option>
            <option value="GenderIssues">GenderIssues</option>
            <option value="GrantWriting">GrantWriting</option>
            <option value="GraphicsImageProcessing">GraphicsImageProcessing</option>
            <option value="HumanComputerInteraction">HumanComputerInteraction</option>
            <option value="LaboratoryEnvironments">LaboratoryEnvironments</option>
            <option value="Literacy">Literacy</option>
            <option value="MathematicsInComputing">MathematicsInComputing</option>
            <option value="Multimedia">Multimedia</option>
            <option value="NetworkingDataCommunications">NetworkingDataCommunications</option>
            <option value="NonMajorCourses">NonMajorCourses</option>
            <option value="ObjectOrientedIssues">ObjectOrientedIssues</option>
            <option value="OperatingSystems">OperatingSystems</option>
            <option value="ParallelProcessing">ParallelProcessing</option>
            <option value="Pedagogy">Pedagogy</option>
            <option value="ProgrammingLanguages">ProgrammingLanguages</option>
            <option value="Research">Research</option>
            <option value="Security">Security</option>
            <option value="SoftwareEngineering">SoftwareEngineering</option>
            <option value="SystemsAnalysisAndDesign">SystemsAnalysisAndDesign</option>
            <option value="UsingTechnologyInClassroom">UsingTechnologyInClassroom</option>
            <option value="WebAndInternetProgramming">WebAndInternetProgramming</option>
            <option value="Other">Other</option>
          </select></td>
              
      <td><input type="text" name="comment" required></td>
      <td><input type="file"  name="uploaded_report" required></td>
      <td><input type="submit" name ="intial_upload" value="Submit" /></td>
    </form>
  </table>  
</main>

<div class="footer">
  <footer><b><br>Contact us ---- +1 813-666-666 ---- r.astley@usf.com</footer>     
</div>